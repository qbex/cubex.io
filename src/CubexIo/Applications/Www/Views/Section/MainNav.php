<?php
/**
 * @author  gareth.evans
 */
namespace CubexIo\Applications\Www\Views\Section;

use Cubex\View\Partial;
use Cubex\View\ViewModel;

class MainNav extends ViewModel
{
  private $_navItems = [
    "index" => [
      "href" => "/",
      "name" => "Home"
    ],
    "about" => [
      "href" => "/about",
      "name" => "About"
    ],
    "docs"  => [
      "href" => "/docs",
      "name" => "Documentation"
    ],
    "learn" => [
      "href" => "http://api.cubex.io",
      "name" => "API Docs"
    ],
    "blog"  => [
      "href" => "/blog",
      "name" => "Blog"
    ]
  ];

  private $_routeResult;

  public function __construct($routeResult)
  {
    $this->_routeResult = $routeResult;
  }

  public function render()
  {
    $nav = new Partial("<li class=\"%s\"><a href=\"%s\">%s</a></li>");

    foreach($this->_navItems as $navItem)
    {
      if($navItem["href"] === '/')
      {
        $active = $this->request()->path() === '/';
      }
      else
      {
        $active = strpos($this->request()->path(), $navItem["href"]) === 0;
      }
      $class = $active ? "active" : "";
      $href  = $navItem["href"];
      $name  = $navItem["name"];

      $nav->addElement($class, $href, $name);
    }

    return $nav;
  }
}
