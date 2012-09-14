<?php



class mantisWrapper
{
    private $soapclient;

    public function __construct()
    {
        $this->soapclient = new nusoap_client(ENDPOINT);
    }

    public function getVersion()
    {
        return $this->soapclient->call('mc_version', array());
    }

    public function getProjectIdFromName($projectName)
    {
        return $this->soapclient->call('mc_project_get_id_from_name',
            array(
                'username' => MANTIS_USERNAME,
                'password' => MANTIS_PASSWORD,
                'project_name' => $projectName
            ));
    }

    public function getProjectIssues($projectId, $pageNumber = '', $perPage = '')
    {
        return $this->soapclient->call('mc_project_get_issues',
            array(
                'username' => MANTIS_USERNAME,
                'password' => MANTIS_PASSWORD,
                'project_id' => $projectId,
                'page_number' => $pageNumber,
                'per_page' => $perPage
            ));
    }

    public function getProjects()
    {
        return $this->soapclient->call('mc_projects_get_user_accessible',
            array(
                'username' => MANTIS_USERNAME,
                'password' => MANTIS_PASSWORD
            )
        );
    }

}