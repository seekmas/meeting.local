<?php
namespace Meeting\ChannelBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class CoreController extends Controller
{
    public function getForm(Request $request , AbstractType $type , $entity)
    {
        $form = $this->createForm($type,$entity);
        $form->handleRequest($request);
        return $form;
    }

    public function redirect($route , $parameters = [] , $referenceType = UrlGeneratorInterface::ABSOLUTE_PATH)
    {
        return parent::redirect($this->generateUrl($route,$parameters,$referenceType));
    }

    public function getManager()
    {
        return $this->getDoctrine()->getManager();
    }

    public function ormWrite($entity)
    {
        $em = $this->getManager();
        $em->persist($entity);
        $em->flush();
        return $entity;
    }

    public function getEntityByName($entityName , $fieldValue)
    {
        return $this->getDoctrine()->getRepository($entityName)->findOneByName($fieldValue);
    }
}
