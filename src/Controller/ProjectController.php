<?php


namespace App\Controller;



use App\Entity\Project;
use App\Entity\Task;
use App\Repository\ProjectRepository;
use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{
    /**
     * @Route("/projectList", name="project_list")
     */
    public function list(ProjectRepository $projectRepository): Response
    {
        $projects = $projectRepository->findAll();

        return $this->render('project/list.html.twig', [
            'projects' => $projects
        ]);
    }

    /**
     * @Route("/project/page/{id}", name="project_page")
     */
    public function page($id,
    EntityManagerInterface $entityManager,
    ProjectRepository $projectRepository,
    TaskRepository $taskRepository)
    {
        $project = $projectRepository->find($id);
        $tasks = $taskRepository->findAll();

        return $this->render('project/page.html.twig', [
            'project' => $project,
            'tasks' => $tasks
        ]);
    }

    /**
     * @Route("/project/add", name="add_project")
     */
    public function add(Request $request, EntityManagerInterface $entityManager)
    {
        if ($request->getMethod() === 'POST') {
            $project = new Project();
            $project->setName($request->request->get('name'));

            
            $entityManager->persist($project);
            $entityManager->flush();

            return $this->redirectToRoute('project_list');
        }

        return $this->render('project/add.html.twig');
    }

    /**
     * @Route("/project/addTask", name="add_task")
     */
    public function addTask(Request $request, EntityManagerInterface $entityManager)
    {
        if ($request->getMethod() === 'POST') {
            $task = new Task();
            $task->setTitle($request->request->get('title'));
            $task->setDescription($request->request->get('description'));

            
            $entityManager->persist($task);
            $entityManager->flush();

            return $this->redirectToRoute('project_list');
        }

        return $this->render('project/addTask.html.twig');
    }
}