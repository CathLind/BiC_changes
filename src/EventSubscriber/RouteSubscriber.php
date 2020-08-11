<?php

/**
 * @file
 * Contains \Drupal\bic_extra\EventSubscriber\RouteSubscriber
 */

namespace Drupal\bic_extra\EventSubscriber;

use Drupal\Core\Routing\RouteSubscriberBase;
use Drupal\Core\Routing\RoutingEvents;
use Symfony\Component\Routing\RouteCollection;

/**
 *
 * Listens to the dynamic route events.
 */
class RouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
   public static function getSubscribedEvents() {
    $events = parent::getSubscribedEvents();
    $events[RoutingEvents::ALTER] = ['onAlterRoutes', -300];
    return $events;
  }



  /**
   * {@inheritdoc}
   */
  protected function alterRoutes(RouteCollection $collection) {
      
       // Change path '/admin/content-kanban' to '/cp_kanban'.*/
        /** @var \Symfony\Component\Routing\Route $route */
    if ($route = $collection->get('content_kanban.kanban')) {
      $route->setPath('/cp_kanban');
    }   
      
      
       // Change path '/admin/content-planner/dashboard' to '/cp_dashboard'.*/
    if ($route = $collection->get('content_planner.dashboard')) {
      $route->setPath('/cp_dashboard');
    }   

      
       // Change path '/admin/content-kanban/logs' to '/cp_kanban/log'.*/
    if ($route = $collection->get('entity.content_kanban_log.collection')) {
      $route->setPath('/cp_kanban/log');
    }   


      
       // Change path '/admin/content-calendar/show-current-year' to '/cp_calendar/current'.*/
    if ($route = $collection->get('content_calendar.current')) {
      $route->setPath('/cp_calendar/current');
    }         

   
    // Controller for showing the libary file */
   if ($route = $collection->get('entity.node.canonical')) {
      $route->setDefault('_controller', '\Drupal\bic_extra\Controller\NodeRedirectController::view');
    }   
                  
  }
  
  
 
  
}
