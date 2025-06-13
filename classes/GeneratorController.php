<?php
namespace Depcore\Pdftoolkit\Classes;


use ApplicationException;
use Backend;
use Backend\Classes\ControllerBehavior;
use Initbiz\Pdfgenerator\Classes\PdfGenerator;
use Initbiz\Pdfgenerator\Models\Settings;
use Lang;
use Depcore\PDFToolkit\Models\Template;
use Redirect;
use Response;

class GeneratorController extends ControllerBehavior {
    /**
     * @var \Backend\Widgets\Form formWidget object
     */
    protected $formWidget;

    /* @var \Depcore\PdfToolkit\Classes\ToolkitTemplate $template */
    protected  $template;

    /**
     * Prepares commonly used view data.
     */
    protected function prepareVars()
    {
        $this->controller->vars['formRecordName'] = "";
    }

    /**
     * preview controller action used for viewing existing model records.
     * This action takes a record identifier (primary key of the model)
     * to locate the record used for sourcing the existing preview data.
     *
     * @param int $recordId Record identifier
     * @param string $context Form context
     * @return void
     */
    public function create($recordId = null, $context = null)
    {
        /* @var \Depcore\PdfToolkit\Classes\ToolkitTemplate $template */
        $this->template = new (Template::find($recordId)->class);

        $this->prepareVars();
        $config = $this->template->getFields();
        $config->model = new \October\Rain\Database\Model; // Dummy model just to avoid errors
        $this->formWidget = $this->makeWidget(\Backend\Widgets\Form::class, $config);
        $this->formWidget->bindToController();
    }

    protected function generate($download = false){

        $params = $this->formWidget->getSaveData();
        $this->template->prepareData($params);
        $pdfGenerator = new PdfGenerator($this->template::getName(), $this->template);
        $pdfGenerator->tokenize = true;
        $pdfGenerator->generatePdf();

        if ($download) {
            return $pdfGenerator->downloadPdf();
        }


        return Backend::url("/depcore/pdftoolkit/generator/preview/".$pdfGenerator->filename."/".$pdfGenerator->token);
    }


    public function preview($filename, $token){
        $directory = Settings::get('pdf_dir', temp_path());
        $directory = ($directory === "") ? temp_path() : $directory;

        if ($token) {
            $localFileName = $directory . '/' . $filename . '_' . $token . '.pdf';
        } else {
            $localFileName = $directory . '/' . $filename . '.pdf';
        }

        $rmAfterDownload = Settings::get('pdf_rm_after_download', true);
        $rmAfterDownload = ($rmAfterDownload === "") ? true : $rmAfterDownload;

        if (!file_exists($localFileName)) {
            return Redirect::to('/404');
        }

        return response()->file($localFileName, [
            'Content-Type' => 'application/pdf',
        ])->deleteFileAfterSend($rmAfterDownload);
    }


    public function create_onGenerate($context = null){
        return $this->generate(true);
    }

    public function create_onPreview($context = null){
        return [
            "newContent" => '<iframe id="pdf-preview" class="d-xl-block d-none w-75" src="'.$this->generate().'#toolbar=0&navpanes=0"></iframe>'
        ];
    }

    public function formRender($options = [])
    {
        if (!$this->formWidget) {
            throw new ApplicationException(Lang::get('backend::lang.form.behavior_not_ready'));
        }

        return $this->formWidget->render($options);
    }

}
