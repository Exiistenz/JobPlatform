<?php

namespace Core\CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Core\CoreBundle\Entity\Folder;
use Core\CoreBundle\Form\FolderType;

/**
 * Folder controller.
 *
 */
class FolderController extends Controller
{
    /**
     * Lists all Folder entities.
     *
     */
    public function indexAction(Request $request)
    {

        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY'))
            throw $this->createAccessDeniedException();

        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();

        // $folders = $em->getRepository('CoreBundle:Folder')->findAll();
        $folders = $em->getRepository('CoreBundle:Folder')->getUserDocs($user->getId());

        return $this->render('CoreBundle:Default:folder/index.html.twig', array(
            'folders' => $folders,
        ));
    }

    /**
     * Creates a new Folder entity.
     *
     */
    public function newAction(Request $request)
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY'))
            throw $this->createAccessDeniedException();

        $user = $this->get('security.token_storage')->getToken()->getUser();

        $folder = new Folder();
        $folder->setUser($user);
        $form = $this->createForm('Core\CoreBundle\Form\FolderType', $folder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($folder);
            $em->flush();

            return $this->redirectToRoute('folder_show', array('id' => $folder->getId()));
        }

        return $this->render('CoreBundle:Default:folder/new.html.twig', array(
            'folder' => $folder,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Folder entity.
     *
     */
    public function showAction(Folder $folder)
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY'))
            throw $this->createAccessDeniedException();

        $deleteForm = $this->createDeleteForm($folder);

        return $this->render('CoreBundle:Default:folder/show.html.twig', array(
            'folder' => $folder,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Folder entity.
     *
     */
    public function editAction(Request $request, Folder $folder)
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY'))
            throw $this->createAccessDeniedException();

        $deleteForm = $this->createDeleteForm($folder);
        $editForm = $this->createForm('Core\CoreBundle\Form\FolderType', $folder);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($folder);
            $em->flush();

            return $this->redirectToRoute('folder_edit', array('id' => $folder->getId()));
        }

        return $this->render('CoreBundle:Default:folder/edit.html.twig', array(
            'folder' => $folder,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Folder entity.
     *
     */
    public function deleteAction(Request $request, Folder $folder)
    {
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY'))
            throw $this->createAccessDeniedException();

        $form = $this->createDeleteForm($folder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($folder);
            $em->flush();
        }

        return $this->redirectToRoute('folder_index');
    }

    /**
     * Creates a form to delete a Folder entity.
     *
     * @param Folder $folder The Folder entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Folder $folder)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('folder_delete', array('id' => $folder->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
