<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Contact.php";

    session();

    if (empty ($_SESSION['list_of_contacts'])) {
        $_SESSION['list_of_contacts'] = array();
    }

    $app = new Silex\Application();

    $app->register(new Silex\Provider\TwigServiceProvider(), array('twig.path' => __DIR__.'/../../views'));

    $app->get("/", function() use ($app){

        return $app['twig']->render('address_home.html.twig', array('contacts' => '' Contact::getAll()));

      });

    $app->post("/create_contact", function() use($app){
        $contact = new Contact($_POST['list_of_contacts']);
        $contact->save();
        return $app['twig']->render('create_contact.html.twig', array('newcontact' => $contact))
    });


    $app->post("/delete_contacts", function() use ($app){
        Contact::delteAll();
        return $app['twig']->render('delete_contacts.html.twig');

    });

      return $app;

 ?>
