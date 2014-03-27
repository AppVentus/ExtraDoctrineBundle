ExtraDoctrineBundle
===================

This bundle gives extra features to doctrine for symfony2


# Configuration
In your doctrine configuration, add the functions:

	doctrine:
    	orm:
        	dql:
            	string_functions:
                	lpad: AppVentus\DoctrineBundle\ORM\Query\AST\Functions\LpadFunction
                	
# Usage

Exemple of query builder usage:
 
 	//we want to have YYYYMM
 	//so we need to have 2 digits for month
	$zeroFillLiteral = $qb->expr()->literal('2');
 	$yearMonthConcatExpr = $qb->expr()->concat('bill.year', 'LPAD(bill.month,'.$zeroFillLiteral.',\'0\')');