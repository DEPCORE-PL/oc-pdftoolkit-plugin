<?php namespace Depcore\PDFToolkit\Jobs;

use Backend;
use Depcore\PDFToolkit\Classes\ToolkitTemplate;
use Depcore\PDFToolkit\Models\GenerationJob;
use Depcore\PDFToolkit\Models\Template;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Initbiz\Pdfgenerator\Classes\PdfGenerator;
use Initbiz\Pdfgenerator\Classes\PdfLayout;

/**
 * Generation Job
 */
class Generation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $payload;
    protected int $template;
    protected int $generateJob;

    /**
     * __construct a new job instance.
     */
    public function __construct(array $payload, int $template, int $generateJob)
    {
        $this->payload = $payload;
        $this->template = $template;
        $this->generateJob = $generateJob;
    }

    /**
     * handle the job.
     */
    public function handle(): void
    {
        /** @var PdfLayout $template */
        $template = Template::find($this->template)->getModel();
        $template->prepareData($this->payload);
        $pdfGenerator = new PdfGenerator($template::getName(), $template);
        $pdfGenerator->tokenize = true;
        $pdfGenerator->generatePdf();

        $job = GenerationJob::find($this->generateJob);
        $job->downloadLink = "/depcore/pdftoolkit/generator/preview/".$pdfGenerator->filename."/".$pdfGenerator->token;
        $job->save();
    }
}
