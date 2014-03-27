<?php

namespace AppVentus\ExtraDoctrineBundle\ORM\Query\AST\Functions;

use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\AST\Functions\FunctionNode;


/**
 * The lpad function of mysql
 *
 * Exemple:
 * //we want to have YYYYMM
 *  //so we need to have 2 digits for month
 *  $zeroFillLiteral = $qb->expr()->literal('2');
 *  $yearMonthConcatExpr = $qb->expr()->concat('bill.year', 'LPAD(bill.month,'.$zeroFillLiteral.',\'0\')');
 */
class LpadFunction extends FunctionNode
{
    public $firstStringPrimary;
    public $secondStringPrimary;
    public $thirdStringPrimary;

    /**
     * @override
     */
    public function getSql(\Doctrine\ORM\Query\SqlWalker $sqlWalker)
    {
        $sql =
            'LPAD('.
                $sqlWalker->walkStringPrimary($this->firstStringPrimary).
            ','.
                $sqlWalker->walkSimpleArithmeticExpression($this->secondStringPrimary).
            ','.
                $sqlWalker->walkStringPrimary($this->thirdStringPrimary).
            ')';

        return $sql;
    }

    /**
     * @override
     */
    public function parse(\Doctrine\ORM\Query\Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);
        $this->firstStringPrimary = $parser->StringPrimary();
        $parser->match(Lexer::T_COMMA);
        $this->secondStringPrimary = $parser->StringPrimary();
        $parser->match(Lexer::T_COMMA);
        $this->thirdStringPrimary = $parser->StringPrimary();
        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }
}

