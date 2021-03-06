<?php
require_once __DIR__ . '/../../../settings.php';
require_once __DIR__ . '/../../../resources/library/nusoap/nusoap.php';

class MantisProvider
{
    /**
     * @var nusoap_client
     */
    private $soapClient;

    public function __construct($soap = null)
    {
        if( empty($soap)) {
            $this->soapClient = new nusoap_client(ENDPOINT);
        }
        else {
            $this->soapClient = $soap;
        }
    }

    public function getVersion()
    {
        return $this->soapClient->call('mc_version', array());
    }

    public function getProjectIdFromName($projectName = null)
    {
        if(empty($projectName)) {
            throw new InvalidArgumentException("Project name can not be null!");
        }

        return $this->soapClient->call('mc_project_get_id_from_name',
            array(
                'username' => MANTIS_USERNAME,
                'password' => MANTIS_PASSWORD,
                'project_name' => $projectName
            ));
    }

    public function getProjectIssues($projectId, $pageNumber = '1', $perPage = '100')
    {
        return $this->soapClient->call('mc_project_get_issues',
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
        return $this->soapClient->call('mc_projects_get_user_accessible',
            array(
                'username' => MANTIS_USERNAME,
                'password' => MANTIS_PASSWORD
            )
        );
    }
}