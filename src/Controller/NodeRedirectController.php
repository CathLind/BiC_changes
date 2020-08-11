<?php


namespace Drupal\bic_extra\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\Core\Entity\EntityInterface;
use Drupal\node\Controller\NodeViewController;
use Drupal\node\Entity\Node;
use Drupal\node\NodeInterface;



/**
 * Custom node redirect controller
 */
class NodeRedirectController extends NodeViewController {

  public function view(EntityInterface $node, $view_mode = 'full', $langcode = NULL) {
    // Redirect to the edit path on the Library type
    if ($node->getType() == 'library') {
      
      $nid = \Drupal::routeMatch()->getParameter('node')->Id();
      $node = Node::load($nid);
      $uri = $node->field_pdf_file->entity->getFileUri();
      $url = file_create_url($uri);
      
      return new RedirectResponse($url);
    }
    // Otherwise, fall back to the parent route controller.
    else {
      return parent::view($node, $view_mode, $langcode);
    }
  }
}
