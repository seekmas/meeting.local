<?php

namespace Meeting\ChannelBundle\Controller;

use Meeting\ChannelBundle\Controller\CoreController as Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class ChannelController extends Controller
{
    /**
     * @Route("/{id}/channel" , name="join_channel")
     * @Template()
     */
    public function indexAction(Request $request , $id = 1)
    {
        $channel = $this->get('e.channel')->findOneById($id);

        return ['channel'=>$channel];
    }
}