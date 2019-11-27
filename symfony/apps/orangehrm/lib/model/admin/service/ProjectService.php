<?php
/**
*-------------------------------------------------------------------------------------------------------
 *  Author     - Hashan Peiris
 *  On (Date)  - 27 July 2011
 *  Comments   - Admin Module ProjectService Data Access CRUD operation
 *  Version    - Version 1.0
 * -------------------------------------------------------------------------------------------------------
*/
class ProjectService extends BaseService {
	

    public function getProjectList( $orderField='project_id',$orderBy='ASC' )
    {

	    	$q = Doctrine_Query::create()
			    ->from('Project')
			    ->orderBy($orderField.' '.$orderBy);
			
			$projectList = $q->execute();
			   
			return  $projectList ;
			

    } 
    

    public function saveProject(Project $project)
    {

	    	$q = Doctrine_Query::create()
			    ->from('Project p')
                ->where('p.name = ?', $project->name)
                ->andWhere('p.customer_id = ?', $project->customer_id);

	    	if (!empty($project->project_id)) {
                $q->andWhere('p.project_id <> ?', $project->project_id) ;
            }

            $count = $q->count();

            if ($count > 0) {
                throw new DuplicateNameException();
            }

        	if( $project->getProjectId()=='')
        	{
	        	$idGenService	=	new IDGeneratorService();
				$idGenService->setEntity($project);
				$project->setProjectId( $idGenService->getNextID() );
        	}
        	$project->save();
        	
        	return $project;
			

    }
    

    public function readProject( $id )
    {

        	$q = Doctrine_Query::create()
				    ->from('Project u')
				     ->where("project_id = ?",$id);
				
			$project = $q->fetchOne();
        	
	    	return $project;

    }
    

    public function deleteProject( $projectList )
    {

	    	if(is_array($projectList ))
	    	{
	        	$q = Doctrine_Query::create()
					    ->delete('Project')
					    ->whereIn('project_id', $projectList  );
	
					   
				$numDeleted = $q->execute();
	    	}

    }
    

  	public function searchProject( $searchMode, $searchValue )
    {

	    	$searchValue	=	trim($searchValue);
        	$q 				= 	Doctrine_Query::create( )
				   				 ->from('Project') 
				    			 ->where("$searchMode = ?",$searchValue);
				    
			$projectList = $q->execute();
			
			return $projectList;
			   

    }
  

    public function getProjectAdmin( Project $project )
    {

        	$q 				= 	Doctrine_Query::create( )
				   				 ->from('ProjectAdmin pa')
				   				 ->leftJoin('pa.Employee emp') 
				    			 ->where("pa.project_id = '".$project->getProjectId()."'");
				    
			
			$projectAdminList = $q->execute();
			
			return $projectAdminList;
			   

    }
    

     public function saveProjectAdmin( $projectId , $empId )
     {

        	if(!$this->isExistingProjectAdmin( $projectId , $empId))
        	{
	        	$projectAdmin	=	new ProjectAdmin();
	        	$projectAdmin->setProjectId( $projectId );
	        	$projectAdmin->setEmpNumber( $empId );
	
	        	$projectAdmin->save();
        	}else
        		return false;
        	

     }
     

    public function deleteProjectAdmin( $projectId, $projecAdmintList )
    {

	    	if(is_array($projecAdmintList ))
	    	{
	        	$q = Doctrine_Query::create()
					    ->delete('ProjectAdmin')
					    ->where("project_id='".$projectId."'")
					    ->whereIn('emp_number', $projecAdmintList  );
	
				//print($q->getSql());
				
				$numDeleted = $q->execute();
	    	}

    }
    

     public function isExistingProjectAdmin( $projectId , $empId )
     {
     		$q 				= 	Doctrine_Query::create( )
				   				 ->from('ProjectAdmin pa')
				    			 ->where("pa.project_id = '".$projectId."' AND pa.emp_number='".$empId."'");
				    
			if($q->count()>0)
				return true ;
			else
				return false;	
     }
     

    public function getProjectActivity( $projectId )
    {

        	$q 				= 	Doctrine_Query::create( )
				   				 ->from('ProjectActivity pa')
				    			 ->where("pa.project_id = '".$projectId."'");
				    
			
			$projectActivityList = $q->execute();
			
			return $projectActivityList;
			   

    }
    

     public function saveProjectActivity( $projectId , $activity )
     {

        	$projectActivity	=	new ProjectActivity();
        	$idGenService	=	new IDGeneratorService();
			$idGenService->setEntity($projectActivity);
			$projectActivity->setActivityId( $idGenService->getNextID() );
        	$projectActivity->setProjectId( $projectId );
        	$projectActivity->setName( $activity );

        	$projectActivity->save();
        	

     }
     

    public function deleteProjectActivity( $activityList )
    {

	    	if(is_array($activityList ))
	    	{
	        	$q = Doctrine_Query::create()
					    ->delete('ProjectActivity')
					    ->whereIn('activity_id', $activityList  );
	
				//print($q->getSql());
				
				$numDeleted = $q->execute();
	    	}

    }
 
    
}