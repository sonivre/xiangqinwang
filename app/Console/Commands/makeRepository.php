<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Konohanaruto\Infrastructures\Common\BaseGenerateRepository;

class makeRepository extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {moduleName} {repositoryName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '创建一个Repository和相应的Interface文件, 用于数据库操作, 默认为Eloquent';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(BaseGenerateRepository $makeRepository)
    {
        $moduleName = $this->argument('moduleName');
        $repositoryName = $this->argument('repositoryName');
        
        
        $makeRepository->init($moduleName, $repositoryName);
        // repository
        $repositoryStatus = $makeRepository->gernerateRepositoryFile();
        // interface
        $interfaceStatus = $makeRepository->gernerateInterfaceFile();
        // model
        $modelStatus = $makeRepository->generateModelFile();
        // provider
        $providerStatus = $makeRepository->generateProviderFile();
        
        if ($repositoryStatus && $interfaceStatus && $modelStatus && $providerStatus) {
            $content = $makeRepository->getManuallyInjectString();
        } else {
            $content = 'failed';
        }
        
        return $this->info($content);
    }
}
