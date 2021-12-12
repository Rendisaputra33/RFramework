<?php

class Commands
{
    /**
     * method for creating a controller
     */
    public function createController(string $name, string $base): void
    {
        # action creating a controller
        touch("$base/app/Controllers/$name.php");
    }

    /**
     * method for creating a view
     */
    public function createView(string $name, string $base): void
    {
        # action creating a views
        mkdir("$base/app/Views/" . ucfirst($name));
        touch("$base/app/Views/" . ucfirst($name) . "/index.php");
    }

    public function createDomain(string $name, string $base): void
    {
        # action creating a domain
        touch("$base/app/Domain/" . ucfirst($name) . ".php");
        $buffer = fopen("$base/app/Domain/" . ucfirst($name) . ".php", "w");
        fwrite($buffer, "<?php\n namespace Rendi\Rframework\Domains;\n class " . ucfirst($name) . "{\n #code...\n }");
        fclose($buffer);
    }
}
