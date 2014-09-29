<?php

namespace Meeting\ChannelBundle\Controller;

use Meeting\AdminBundle\Entity\Channel;
use Meeting\AdminBundle\Form\ChannelType;
use Meeting\ChannelBundle\Controller\CoreController as Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    /**
     * @Route("/" , name="home_page")
     * @Template()
     */
    public function indexAction(Request $request)
    {

        $channel = new Channel();
        $type = new ChannelType();
        $form = $this->getForm($request,$type,$channel);
        if($form->isValid())
        {
            if($this->getUser()==null)
            {
                return $this->redirect('fos_user_security_login');
            }

            if($oldChannel = $this->getEntityByName( 'MeetingAdminBundle:Channel' , $channel->getName()))
            {
                return $this->redirect('join_channel',['id'=>$oldChannel->getId()]);
            }

            $channel->setCreatedAt( new \Datetime());
            $channel->setDescription('A anonymous channel');
            $channel->setIsPublic(true);
            $channel->setUser($this->getUser());

            $this->ormWrite($channel);
            return $this->redirect('join_channel',['id'=>$channel->getId()]);
        }

        return [
            'form' => $form->createView() ,
        ];
    }
}
