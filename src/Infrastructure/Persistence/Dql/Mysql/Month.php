<?php
declare(strict_types=1);

namespace Ranky\MediaBundle\Infrastructure\Persistence\Dql\Mysql;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\AST\Node;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;
use Doctrine\ORM\Query\TokenType;


/**
 * @author https://github.com/beberlei/DoctrineExtensions
 */
class Month extends FunctionNode
{
    public Node|string|null $date = null;

    public function getSql(SqlWalker $sqlWalker): string
    {
        return 'MONTH('.$sqlWalker->walkArithmeticPrimary($this->date).')';
    }

    public function parse(Parser $parser): void
    {
        $parser->match(TokenType::T_IDENTIFIER);
        $parser->match(TokenType::T_OPEN_PARENTHESIS);

        $this->date = $parser->ArithmeticPrimary();

        $parser->match(TokenType::T_CLOSE_PARENTHESIS);
    }
}
