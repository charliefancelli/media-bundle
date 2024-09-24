<?php
declare(strict_types=1);

namespace Ranky\MediaBundle\Infrastructure\Persistence\Dql\Mysql;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\AST\Node;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;
use Doctrine\ORM\Query\TokenType;


class MimeSubType extends FunctionNode
{
    public Node|string|null $field = null;

    /**
     * @throws \Doctrine\ORM\Query\QueryException
     */
    public function parse(Parser $parser): void
    {
        $parser->match(TokenType::T_IDENTIFIER);
        $parser->match(TokenType::T_OPEN_PARENTHESIS);

        $this->field = $parser->ArithmeticPrimary();

        $parser->match(TokenType::T_CLOSE_PARENTHESIS);
    }


    /**
     * @throws \Doctrine\ORM\Query\AST\ASTException
     */
    public function getSql(SqlWalker $sqlWalker): string
    {
        return sprintf(
            'SUBSTR(%1$s, INSTR(%1$s, "/") + 1, LENGTH(%1$s))',
            $this->field->dispatch($sqlWalker)
        );
    }

}
