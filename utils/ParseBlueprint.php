<?php

require "vendor/autoload.php";

use PhpParser\Error;
use PhpParser\Node;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitorAbstract;
use PhpParser\ParserFactory;

class ReturnTypeVisitor extends NodeVisitorAbstract
{
    private $returnType;
    private $functions = [];

    public function __construct($returnType)
    {
        $this->returnType = $returnType;
    }

    public function enterNode(Node $node)
    {
        if ($node instanceof Node\Stmt\ClassMethod) {
            $docComment = $node->getDocComment();
            if ($docComment) {
                $docText = $docComment->getText();
                if (
                    preg_match(
                        "/@return\s+" .
                            preg_quote($this->returnType, "/") .
                            "\b/",
                        $docText
                    )
                ) {
                    dump([
                        "functionName" => $node->name->toString(),
                        "docComment" => $docText,
                        "parameters" => $node->params,
                    ]);

                    $this->functions[] = [
                        "functionName" => $node->name->toString(),
                        "docComment" => $docText,
                        "parameters" => array_map(function ($param) {
                            return $param->name->toString();
                        }, $node->params),
                    ];
                }
            }
        }
    }

    public function getFunctions(): array
    {
        return $this->functions;
    }
}

// get path to PHP file

$code = file_get_contents("utils/files/Blueprint.php"); // Change this to your PHP file path

$parser = (new ParserFactory())->createForNewestSupportedVersion();
$traverser = new NodeTraverser();

$returnType = "\Illuminate\Database\Schema\ColumnDefinition";
$visitor = new ReturnTypeVisitor($returnType);
$traverser->addVisitor($visitor);

try {
    $ast = $parser->parse($code);
    $traverser->traverse($ast);
} catch (Error $error) {
    echo "Parse Error: ", $error->getMessage();
}
