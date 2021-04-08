<?php

namespace App\Controller;


use App\Repository\TaskRepository;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;



class ApiController extends AbstractController
{
    /**
     * @Route("/api/projects", name="api_project_list", methods={"GET"})
     */
    public function listProjects(Request $request, ProjectRepository $projectRepository)
    {
     
        $projects = $projectRepository->findAll();
        return $this->json($projects, 200, [], [
            AbstractObjectNormalizer::ATTRIBUTES => [
                'name' ]
        ]);
    }

    /**
     * @Route("/api/projects/{id}", name="api_project_task", methods={"GET"})
     */
    public function listTask($id, Request $request,
     ProjectRepository $projectRepository, 
     TaskRepository $taskRepository, 
     ValidatorInterface $validator)
    {
     
        $tasks = $projectRepository->find($id);
       

        return $this->json([
            'data' =>$tasks
        ]);
    }
    

}