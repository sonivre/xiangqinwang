<?php

namespace App\Konohanaruto\Infrastructures\Common;

class GenerateRepository extends BaseGenerateRepository
{
    const ELOQUENT_TYPE = 'Eloquent';
    const MONGO_TYPE = 'MongoDB';
    const PREFIX_PATH = 'app/Konohanaruto/Repositories';
    const PREFIX_MODEL_PATH = 'app/Konohanaruto/Models';
    const PREFIX_PROVIDER_PATH = 'app/Konohanaruto/Providers';
    
    private $type;
    private $moduleName;
    private $repositoryName;
    
    public function __construct()
    {
    }
    
    public function init($moduleName = null, $repositoryName = null)
    {
        $this->type = self::ELOQUENT_TYPE;
        if (! empty($moduleName) && ! empty($repositoryName)) {
            $this->moduleName = $moduleName;
            $this->repositoryName = $repositoryName;
        } else {
            throw new \Exception('参数错误');
        }
    }
    
    public function getRepositoryType()
    {
        return $this->type;
    }
    
    /**
     * 设置RepositoryType类型
     * 
     * @param string $type
     */
    public function setRepositoryType($repositoryType = null)
    {
        if (empty($repositoryType)) {
            return false;
        }
        
        $this->type = $repositoryType;
        
        return true;
    }
    
    /**
     * 得到文件写入目录
     * 
     * @return string
     */
    public function writtenPath()
    {
        return ! empty($this->moduleName) ? self::PREFIX_PATH . '/' . $this->moduleName : self::PREFIX_PATH;
    }
    
    /**
     * 得到Repository文件名
     * 
     * @param void
     * @return mixed
     */
    public function getRepositoryFileName()
    {
        return $this->writtenPath() . '/' . $this->repositoryName . '/' . $this->repositoryName . $this->type . 'Repository.php';
    }
    
    /**
     * 得到Interface文件名
     *
     * @param void
     * @return mixed
     */
    public function getInterfaceFileName()
    {
        return $this->writtenPath() . '/' . $this->repositoryName . '/' . $this->repositoryName . 'RepositoryInterface.php';
    }
    
    public function gernerateRepositoryFile()
    {
        $content = <<<CODE
<?php

namespace App\Konohanaruto\Repositories\\{$this->moduleName}\\$this->repositoryName;

use App\Konohanaruto\Repositories\\{$this->moduleName}\\{$this->type}Repository;

class {$this->repositoryName}{$this->type}Repository extends {$this->type}Repository implements {$this->repositoryName}RepositoryInterface
{

    public function getModel()
    {
        return \App\Konohanaruto\Models\\{$this->moduleName}\\{$this->repositoryName}::class;
    }
}
CODE;
        $repositoryFolder = dirname($this->getRepositoryFileName());
        $folderStatus = $this->createFolder($repositoryFolder);
        
        if (! $folderStatus) {
            return false;
        }
        
        // 创建文件
        $repositoryFileName = $this->getRepositoryFileName();
        $fp = @fopen($repositoryFileName, 'wb');
        
        if (! $fp) {
            return false;
        }
        
        $handlerStatus = fwrite($fp, $content);
        fclose($fp);
        
        return $handlerStatus === false ? false : true;
    }
    
    public function gernerateInterfaceFile()
    {
        $content = <<<CODE
<?php

namespace App\\Konohanaruto\\Repositories\\{$this->moduleName}\\{$this->repositoryName};

interface {$this->repositoryName}RepositoryInterface
{
    
}
CODE;
        $interfaceFolder = dirname($this->getInterfaceFileName());
        $folderStatus = $this->createFolder($interfaceFolder);
    
        if (! $folderStatus) {
            return false;
        }
    
        // 创建文件
        $interfaceFileName = $this->getInterfaceFileName();
        $fp = @fopen($interfaceFileName, 'wb');
    
        if (! $fp) {
            return false;
        }
    
        $handlerStatus = fwrite($fp, $content);
        fclose($fp);
    
        return $handlerStatus === false ? false : true;
    }
    
    /**
     * 生成Model文件
     * 
     * @return boolean
     */
    public function generateModelFile()
    {
        $modelFilePath = self::PREFIX_MODEL_PATH . '/' . $this->moduleName . '/' . $this->repositoryName . '.php';
        $modelDirectory = dirname($modelFilePath);
        $folderStatus = $this->createFolder($modelDirectory);
        
        if (! $folderStatus) {
            return false;
        }
        
        $content = <<<CODE
<?php
namespace App\\Konohanaruto\\Models\\{$this->moduleName};

use Illuminate\\Database\\Eloquent\\Model;

class {$this->repositoryName} extends Model
{
    protected \$table = '';
    protected \$primaryKey = '';
    public \$timestamps = false;
    
}
CODE;
        $fp = @fopen($modelFilePath, 'wb');
        
        if (! $fp) {
            return false;
        }
        
        $handlerStatus = fwrite($fp, $content);
        fclose($fp);
        
        return $handlerStatus === false ? false : true;
    }
    
    /**
     * 生成Provider文件
     * 
     * @param void
     * @return mixed
     */
    public function generateProviderFile()
    {
        $providerFilePath = self::PREFIX_PROVIDER_PATH . '/' . $this->moduleName . '/' . $this->repositoryName . 'ServiceProvider.php';
        $providerDirectory = dirname($providerFilePath);
        $folderStatus = $this->createFolder($providerDirectory);
        
        if (! $folderStatus) {
            return false;
        }
        
        $content = <<<CODE
<?php

namespace App\\Konohanaruto\\Providers\\{$this->moduleName};
use Illuminate\\Support\\ServiceProvider;

class {$this->repositoryName}ServiceProvider extends ServiceProvider
{
    public function register()
    {
        \$this->app->bind(
            'App\\Konohanaruto\\Repositories\\{$this->moduleName}\\{$this->repositoryName}\\{$this->repositoryName}RepositoryInterface',
            'App\\Konohanaruto\\Repositories\\{$this->moduleName}\\{$this->repositoryName}\\{$this->repositoryName}EloquentRepository'
        );
    }
}
CODE;
        $fp = @fopen($providerFilePath, 'wb');
        
        if (! $fp) {
            return false;
        }
        
        $handlerStatus = fwrite($fp, $content);
        fclose($fp);
        
        return $handlerStatus === false ? false : true;
    }
    
    /**
     * 输出需要手动绑定到服务容器的内容
     * 
     * @return string
     */
    public function getManuallyInjectString()
    {
        return "App\\Konohanaruto\\Providers\\{$this->moduleName}\\{$this->repositoryName}ServiceProvider::class";
    }
    
    /**
     * 创建目录
     * 
     * @param string $path
     * @return boolean
     */
    protected function createFolder($directory)
    {
        if (! file_exists($directory)) {
            if (! mkdir($directory, 0777, true)) {
                // throw new \Exception('创建目录失败, 请检查目录权限！');
                return false;
            }
        }
        
        return true;
    }
    
    /**
     * 创建Repository相关文件
     * 
     * @param string $filePath 文件路径
     * @return boolean
     */
    protected function createRepositoryFile($repositoryFileName)
    {
        return touch($repositoryFileName);
    }
}