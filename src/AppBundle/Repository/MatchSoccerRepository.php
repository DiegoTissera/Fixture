<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * MatchSoccerRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MatchSoccerRepository extends EntityRepository
{
	// private $entityManager;

	public function positionFixture()
	{
	 	$entityManager = $this->getEntityManager();

	    $query = $entityManager->createQuery(
	        'SELECT
            t.name,
            COUNT(t.name) AS matches_played,
            SUM(
                CASE
                    WHEN ms.home = t.id
                    THEN ms.homegoals
                    ELSE 0
                END
            )
            + SUM(
                CASE
                    WHEN ms.visitor = t.id
                    THEN ms.visitorgoals
                    ELSE 0
                END
            ) AS goals_scored,
            SUM(
                CASE
                    WHEN ms.home != t.id
                    THEN ms.homegoals
                    ELSE 0
                END
            )
            + SUM(
                CASE
                    WHEN ms.visitor != t.id
                    THEN ms.visitorgoals
                    ELSE 0
                END
            ) AS goals_against,
            SUM(
                CASE
                    WHEN ms.home = t.id
                    AND ms.homegoals > ms.visitorgoals
                    THEN 3
                    WHEN ms.home = t.id
                    AND ms.homegoals = ms.visitorgoals
                    THEN 1
                    WHEN ms.visitor = t.id
                    AND ms.visitorgoals > ms.homegoals
                    THEN 3
                    WHEN ms.visitor = t.id
                    AND ms.visitorgoals = ms.homegoals
                    THEN 1
                    ELSE 0
                END
            ) AS points,
            SUM(
                CASE
                    WHEN ms.home = t.id
                    AND ms.homegoals > ms.visitorgoals
                    THEN 1
                    WHEN ms.visitor = t.id
                    AND ms.visitorgoals > ms.homegoals
                    THEN 1
                    ELSE 0
                END
            ) AS matches_won,
            SUM(
                CASE
                    WHEN ms.home = t.id
                    AND ms.homegoals = ms.visitorgoals
                    THEN 1
                    WHEN ms.visitor = t.id
                    AND ms.visitorgoals = ms.homegoals
                    THEN 1
                    ELSE 0
                END
            ) AS matches_drawn,
            SUM(
                CASE
                    WHEN ms.home = t.id
                    AND ms.homegoals < ms.visitorgoals
                    THEN 1
                    WHEN ms.visitor = t.id
                    AND ms.visitorgoals < ms.homegoals
                    THEN 1
                    ELSE 0
                END
            ) AS matches_lost,
            (
                (SUM(
                    CASE
                        WHEN ms.home = t.id
                        THEN ms.homegoals
                        ELSE 0
                    END
                )
                + SUM(
                    CASE
                        WHEN ms.visitor = t.id
                        THEN ms.visitorgoals
                        ELSE 0
                    END
                )) - (SUM(
                    CASE
                        WHEN ms.home != t.id
                        THEN ms.homegoals
                        ELSE 0
                    END
                )
                + SUM(
                    CASE
                        WHEN ms.visitor != t.id
                        THEN ms.visitorgoals
                        ELSE 0
                    END
                ))
            ) AS goal_difference
	        FROM AppBundle\Entity\MatchSoccer ms
	        JOIN AppBundle\Entity\Team t WITH ms.home = t.id OR ms.visitor = t.id
	        GROUP BY t.id
	        ORDER BY points DESC, goal_difference DESC, goals_scored DESC, goals_against ASC'
    	);

	    return $query->getResult();
	    $fixture = getResult();
	}
}