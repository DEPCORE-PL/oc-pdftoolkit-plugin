<?php
namespace Depcore\PDFToolkit\Classes;


use ApplicationException;
use Backend;
use Backend\Classes\ControllerBehavior;
use Depcore\PDFToolkit\Jobs\Generation;
use Depcore\PDFToolkit\Models\GenerationJob;
use Initbiz\Pdfgenerator\Classes\PdfGenerator;
use Initbiz\Pdfgenerator\Models\Settings;
use Lang;
use Depcore\PDFToolkit\Models\Template;
use League\Csv\Exception;
use Redirect;

class GeneratorController extends ControllerBehavior {
    /**
     * @var \Backend\Widgets\Form formWidget object
     */
    protected $formWidget;

    /* @var \Depcore\PdfToolkit\Classes\ToolkitTemplate $template */
    protected  $template;

    protected int $templateId;

    /**
     * Prepares commonly used view data.
     */
    protected function prepareVars()
    {
        $this->controller->vars['formRecordName'] = "";
    }


    /**
     * Displays the main UI for the PDF generator.
     *
     * This method is named "create" because it initiates the creation of a new PDF from a template.
     *
     * @param int $recordId The ID of the record to use for PDF generation.
     * @param mixed    $context    Optional. Additional context for the PDF generation process.
     * @return \October\Rain\Halcyon\Model|void
     */
    public function create($recordId, $context = null)
    {
        /* @var \Depcore\PdfToolkit\Classes\ToolkitTemplate $template */
        $this->template = new (Template::find($recordId)->class);
        $this->templateId = $recordId;

        $this->prepareVars();
        $config = $this->template->getFields();
        $config->model = new \October\Rain\Database\Model; // Dummy model just to avoid errors
        $this->formWidget = $this->makeWidget(\Backend\Widgets\Form::class, $config);
        $this->formWidget->bindToController();
    }

    /**
     * Generates the PDF based on the provided data and template.
     *
     * @param bool $download Whether to download the generated PDF or just preview it.
     * @return string|void The URL to the generated PDF or a file download response.
     */
    protected function generate($download = false){

        $params = $this->formWidget->getSaveData();

        $job = new GenerationJob();
        $job->template = Template::find($this->templateId);
        $job->payload = serialize($params);
        $job->save();

        Generation::dispatch($params, $this->templateId, $job->id);
    }


    /**
     * Generates a web response for previewing a PDF file in web browsers.
     *
     * This method takes a PDF filename and an access token, then returns an HTTP response
     * that allows the PDF to be previewed securely in the browser.
     *
     * @param string $filename The name of the PDF file to be previewed.
     * @param string $token The unique token used to distinguish files with the same name.
     *
     * @return \Illuminate\Http\Response The HTTP response containing the PDF preview.
     */
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

        $headers = [
            'Content-Type' => 'application/pdf',
        ];

        $filename = \Request::get('filename');
        if (!empty($filename)) {
            $headers['Content-Disposition'] = 'inline; filename="' . $filename . '.pdf"';
        }

        return response()
            ->file($localFileName, $headers)
            ->deleteFileAfterSend(false);
    }


    /**
     * Handles the generation process when the "Generate" action is triggered.
     *
     * @param mixed $context Optional context information for the generation process.
     * @return void
     */
    public function create_onGenerate($context = null){
        return $this->generate(true);
    }

    /**
     * Handles the preview action for creating a PDF.
     *
     * Generates an iframe HTML element that displays a preview of the generated PDF.
     * The iframe is styled to be visible only on extra-large screens and hides the toolbar and navigation panes.
     *
     * @param mixed $context Optional context for the preview action.
     * @return array Returns an array containing the HTML content for the PDF preview.
     */
    public function create_onPreview($context = null){
        return [
            "newContent" => '<iframe id="pdf-preview" class="d-xl-block d-none w-75" src="'.$this->generate().'#toolbar=0&navpanes=0"></iframe>'
        ];
    }

    /**
     * Renders the form widget.
     *
     * Checks if the form widget is initialized; if not, throws an ApplicationException.
     * Otherwise, renders and returns the form widget with the provided options.
     *
     * @param array $options Optional array of options to customize the form rendering.
     * @return string The rendered form widget HTML.
     * @throws \ApplicationException If the form widget is not ready.
     */
    public function formRender($options = [])
    {
        if (!$this->formWidget) {
            throw new ApplicationException(Lang::get('backend::lang.form.behavior_not_ready'));
        }

        return $this->formWidget->render($options);
    }

}
