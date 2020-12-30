<?php

use Saweblia\Model\Adresse;
use Saweblia\Model\Client;

include_once __DIR__ . '/vendor/autoload.php';
include_once __DIR__ . '/conf/config.php';

header("Access-Control-Allow-Origin: *");

$router = new Klein\Klein();

//repos clients

$router->post('/clients', function ($req) {
    if (strpos(strtolower($req->headers()['Content-Type']), 'application/json') === 0) {
        $data = $req->body();

        $clientData = json_decode($data, true);
        if (is_array($clientData)) {

            try {
                if (isset($clientData['telephone'])) {
                    $IDclient = 0;
                    $IDadresse = 0;
                    $client = new \partner\Client();
                    $client->setTelephone($clientData['telephone']);
                    $client->setType("societe");
                    if (isset($clientData['nom'])) {
                        $client->setNom($clientData['nom']);
                    }
                    if (isset($clientData['email'])) {
                        $client->setEmail($clientData['email']);
                    }
                    if (isset($clientData['mot_de_passe'])) {
                        $client->setPassword(hash('sha256', $clientData['mot_de_passe']));
                    }
                    $client->save();
                    $IDclient = $client->getClientID();
                    if (isset($clientData['libelle_adresse'])) {
                        if (isset($clientData['ville'])) {
                            $adresse = new \partner\Adresse();
                            $adresse->setLibelle($clientData['libelle_adresse']);
                            $adresse->setVille($clientData['ville']);
                            if (isset($adresseData['numero_bureau'])) {
                                $adresse->setOfficeNumber($adresseData['numero_bureau']);
                            }
                            if (isset($adresseData['surface_bureau'])) {
                                $adresse->setOfficeSurface($adresseData['surface_bureau']);
                            }
                            $adresse->setClientID($client->getClientID());
                            $adresse->save();
                            $IDadresse = $adresse->getAdressID();
                        }else
                            echo "manque d'un champs obligatoir (ville) ";
                    }
                }else
                    echo "telephone client required";

                header('Content-type: application/json');
                echo "{ clientID : $IDclient, adresseID : $IDadresse}";
                die();

            }
            catch
            (\Exception $e) {
                http_response_code(401);
                die();
            }

        }

        http_response_code(400);
        exit();

    }
});

$router->put('/clients/[i:telephone]', function ($req) {
    if (strpos(strtolower($req->headers()['Content-Type']), 'application/json') === 0) {
        $data = $req->body();

        $clientData = json_decode($data, true);
        $telephone = $req->telephone;

        if (is_array($clientData)) {
            try {
                if ($telephone > 0) {
                    $client = \partner\ClientQuery::create()
                    ->findOneByTelephone($telephone);

                    if (isset($clientData['type'])) {
                        $client->setType($clientData['type']);
                    }
                    if (isset($clientData['nom'])) {
                        $client->setNom($clientData['nom']);
                    }
                    if (isset($clientData['telephone'])) {
                        $client->setTelephone($clientData['telephone']);
                    }
                    if (isset($clientData['email'])) {
                        $client->setEmail($clientData['email']);
                    }
                    if (isset($clientData['mot_de_passe'])) {
                        $client->setPassword(hash('sha256', $clientData['mot_de_passe']));
                    }

                    if (isset($clientData['access_channel'])) {
                        $client->setAccessChannel($clientData['access_channel']);
                    }
                    if (isset($clientData['last_connection'])) {
                        $client->setLastConnection($clientData['last_connection']);
                    }
                    if (isset($clientData['last_updated'])) {
                        $client->setLastUpdated($clientData['last_updated']);
                    }

                    $client->save();
                }
                header('Content-type: application/json');
                echo "{ code: 200 }";
                die();

            } catch (\Exception $e) {
                http_response_code(401);
                die();
            }
        }

        http_response_code(400);
        exit();

    }
});

$router->get('/clients/[i:telephone]', function ($req) {
$telephone = $req->telephone;

    if ($telephone > 0){
    $client = \partner\ClientQuery::create()
        ->findOneByTelephone($telephone);
    if ($client != null) {
    header('Content-type: application/json');
    echo $client->toJSON();
    die();
    }else
        echo '{"client data not found"}';
    }http_response_code(404);
    echo '{"clientID incorrect"}';
    exit();
});

//repos adresse

$router->get('/adresse_client/[i:telephone]', function ($req) {
$telephone= $req->telephone;
if ($telephone > 0) {
    $client = \partner\ClientQuery::create()
        ->findOneByTelephone($telephone);
    $adresse = \partner\AdresseQuery::create()
        ->findByClientID($client->getClientID());
    if ($adresse != null) {
        header('Content-type: application/json');
        echo $adresse->toJSON();
        die();
    }else
        echo '{"adresse not found",}';
}
    http_response_code(404);
    echo '{"clientId incorrect"}';
    exit();
});

$router->get('/adresse_client/[i:id]', function ($req) {
    $id= $req->id;
    if ($id > 0) {
        $adresse = \partner\AdresseQuery::create()
            ->findByClientID($id);
        if ($adresse != null) {
            header('Content-type: application/json');
            echo $adresse->toJSON();
            die();
        }else
            echo '{"adresse not found",}';
    }
    http_response_code(404);
    echo '{"clientId incorrect"}';
    exit();
});

$router->post('/adresses', function ($req) {
    if (strpos(strtolower($req->headers()['Content-Type']), 'application/json') === 0) {
        $data = $req->body();

        $adresseData = json_decode($data, true);
        if (is_array($adresseData)) {
            try {
                $adresse = new \partner\Adresse();

                if (isset($adresseData['libelle'])) {
                    $adresse->setLibelle($adresseData['libelle']);
                }
                if (isset($adresseData['quartier'])) {
                    $adresse->setQuartier($adresseData['quartier']);
                }
                if (isset($adresseData['rue'])) {
                    $adresse->setRue($adresseData['rue']);
                }
                if (isset($adresseData['ville'])) {
                    $adresse->setVille($adresseData['ville']);
                }
                if (isset($adresseData['numero_bureau'])) {
                    $adresse->setOfficeNumber($adresseData['numero_bureau']);
                }
                if (isset($adresseData['surface_bureau'])) {
                    $adresse->setOfficeSurface($adresseData['surface_bureau']);
                }
                if (isset($adresseData['telephone_client'])) {
                    $client = \partner\ClientQuery::create()
                        ->findOneByTelephone($adresseData['telephone_client']);
                    if ($client != null) {
                        $adresse->setClientID($client->getClientID());
                    }else
                        echo '"error: client_not_found"';
                }


                $adresse->save();
                header('Content-type: application/json');
                echo "{ success: 200}";
                die();

            } catch (\Exception $e) {
                http_response_code(401);
                die();
            }
        }

        http_response_code(400);
        exit();

    }
});

//repos categorie

$router->get('/categories', function ($req) {

    $categorie = \partner\CategorieQuery::create()->find();
    header('Content-type: application/json');
    echo $categorie->toJSON();
    die();
});

$router->get('/categories/[i:id]', function ($req) {
    $categorieID = $req->libelle;

    if ($categorieID > 0) {
        $categorie = \partner\CategorieQuery::create()
            ->findOneByCategorieID($categorieID);
        if ($categorie != null) {
            header('Content-type: application/json');
            echo $categorie->toJSON();
            die();
        }else
            echo '{"categorie data not found"}';
    }
    http_response_code(404);
    echo '{"libelle categorie not found"}';
    exit();
});

$router->get('/categories/[:libelle]', function ($req) {
    $categorieLibelle = $req->libelle;

    if ($categorieLibelle != null) {
        $categorie = \partner\CategorieQuery::create()
            ->findOneByLibelle($categorieLibelle);
        if ($categorie != null) {
            header('Content-type: application/json');
            echo $categorie->toJSON();
            die();
        }else
            echo '{"categorie data not found"}';
    }
    http_response_code(404);
    echo '{"libelle categorie not found"}';
    exit();
});

// prestation repos

$router->get('/prestations_technoparc', function ($req) {

    $prestation = \partner\PrestationQuery::create()
        ->find();

    header('Content-type: application/json');
    echo $prestation->toJSON();
    die();
});

$router->get('/prestations/[i:id]', function ($req) {

    $prestationID = $req->id;
    if ($prestationID != null) {
        $prestation = \partner\PrestationQuery::create()
            ->findByPrestationID($prestationID);
        if ($prestation != null) {
            header('Content-type: application/json');
            echo $prestation->toJSON();
            die();
        } else
            echo '{"prestation data not found"}';
    }
    http_response_code(404);
    echo '{"libelle prestation incorrect"}';
    exit();
});

$router->get('/prestations/[:libelle]', function ($req) {

    $prestationlibelle = $req->libelle;
    if ($prestationlibelle != null) {
        $prestation = \partner\PrestationQuery::create()
            ->findOneByLibelle($prestationlibelle);
        if ($prestation != null) {
            header('Content-type: application/json');
            echo $prestation->toJSON();
            die();
        } else
            echo '{"prestation data not found"}';
    }
    http_response_code(404);
    echo '{"libelle prestation incorrect"}';
    exit();
});

$router->get('/prestations_de_service/[i:id]', function ($req) {

    $serviceID = $req->id;
    if ($serviceID > 0) {
        $prestation = \partner\PrestationQuery::create()
            ->findByServiceID($serviceID);
        if ($prestation != null) {
            header('Content-type: application/json');
            echo $prestation->toJSON();
            die();
        }else
            echo '{"prestation data not found"}';
    }
    http_response_code(404);
    echo '{"serviceID incorrect"}';
    exit();
});

$router->get('/prestations_de_service/[:libelle]', function ($req) {

    $servicelibelle = $req->libelle;
    if ($servicelibelle != null) {
        $service = \partner\ServiceQuery::create()
            ->findOneByLibelle($servicelibelle);
        $prestation = \partner\PrestationQuery::create()
            ->findOneByServiceID($service->getServiceID());
        if ($prestation != null) {
            header('Content-type: application/json');
            echo $prestation->toJSON();
            die();
        }else
            echo '{"prestation data not found"}';
    }
    http_response_code(404);
    echo '{"libelle service incorrect"}';
    exit();
});

// service repos

$router->get('/services', function ($req) {

    $service = \partner\ServiceQuery::create()
        ->find();
    header('Content-type: application/json');
    echo $service->toJSON();
    die();
});

$router->get('/services/[i:id]', function ($req) {

    $serviceID = $req->id;
    if ($serviceID > 0) {
        $service = \partner\ServiceQuery::create()
            ->findOneByServiceID($serviceID);
        if ($service != null){
            header('Content-type: application/json');
            echo $service->toJSON();
            die();
        } else
            echo '{"service not found"}';
    }
    http_response_code(404);
    echo '{"serviceID incorrect"}';
    exit();
});

$router->get('/services/[:libelle]', function ($req) {

    $servicelibelle = $req->libelle;
    if ($servicelibelle != null) {
        $service = \partner\ServiceQuery::create()
            ->findOneByLibelle($servicelibelle);
        if ($service != null) {
            header('Content-type: application/json');
            echo $service->toJSON();
            die();
        }else
            echo '{"service not found"}';
    }
    http_response_code(404);
    echo '{"libelle service incorrect"}';
    exit();
});

$router->get('/services_de_categorie/[i:id]', function ($req) {
    $categorieID = $req->id;
    if ($categorieID > 0) {
        $service = \partner\ServiceQuery::create()
            ->findOneByCategorieID($categorieID);
        if ($service != null) {
            header('Content-type: application/json');
            echo $service->toJSON();
            die();
        }else
            echo '{"pas de service pour cette categorie"}';
    }
    http_response_code(404);
    echo '{"categorieID incorrect"}';
    exit();

});

$router->get('/services_de_categorie/[:libelle]', function ($req) {
    $categorielibelle = $req->libelle;
    if ($categorielibelle != null) {
        $categorie = \partner\CategorieQuery::create()
            ->findOneByLibelle($categorielibelle);
        $service = \partner\ServiceQuery::create()
            ->findOneByCategorieID($categorie->getCategorieID());
        if ($service != null) {
            header('Content-type: application/json');
            echo $service->toJSON();
            die();
        }else
            echo '{"service data not found"}';
    }
    http_response_code(404);
    echo '{"libelle categorie incorrect"}';
    exit();
});

// devi repos

$router->get('/devis_client/[i:telephone]', function ($req) {
    $clientTelephone = $req->telephone;
    if ($clientTelephone > 0) {
        $client = \partner\ClientQuery::create()
            ->findOneByTelephone($clientTelephone);
        $Devis = \partner\DeviQuery::create()
            ->findByClientID($client->getClientID());
        if ($Devis != null){
            header('Content-type: application/json');
            echo $Devis->toJSON();
            die();
        }else
            echo '{"client data not found"}';
    }
    http_response_code(404);
    echo '{"telephone incorrect"}';
    exit();
});

$router->post('/devi', function ($req) {
    if (strpos(strtolower($req->headers()['Content-Type']), 'application/json') === 0) {
        $data = $req->body();

        $Data = json_decode($data, true);
        if (is_array($Data)) {
            try {
                $devi = new \partner\Devi();

                if (isset($Data['date_commande'])) {
                    $devi->setDateCommande($Data['date_commande']);
                }
                if (isset($Data['date_intervention'])) {
                    $devi->setDateIntervention($Data['date_intervention']);
                }
                if (isset($Data['mode_paiement'])) {
                    $devi->setModePaiement($Data['mode_paiement']);
                }
                if (isset($Data['telephone'])) {
                    $client = \partner\ClientQuery::create()
                        ->findOneByTelephone($Data['telephone']);
                    $devi->setClientID($client->getClientID());
                }
                if (isset($Data['utilisateur'])) {
                    $utilisateur = \partner\UtilisateurQuery::create()
                        ->findOneByLogin($Data['utilisateur']);
                    $devi->setUtilisateurID($utilisateur->getUtilisateurID());
                }


                $devi->save();
                $ID = $devi->getDeviID();

                header('Content-type: application/json');
                echo "{ deviID: $ID}";
                die();

            } catch (\Exception $e) {
                http_response_code(401);
                die();
            }
        }

        http_response_code(400);
        exit();

    }
});

$router->get('/devi/[i:id]', function ($req) {

    $deviID = $req->id;
    if ($deviID > 0) {
        $devi = \partner\DeviQuery::create()
            ->findOneByDeviID($deviID);
        if ($deviID != null) {
            header('Content-type: application/json');
            echo $devi->toJSON();
            die();
        } else
            echo '{"devi data not found"}';
    }
    http_response_code(404);
    echo '{"id devi incorrect"}';
    exit();
});

// prestation_devi repos

$router->post('/prestation_devis', function ($req) {
    if (strpos(strtolower($req->headers()['Content-Type']), 'application/json') === 0) {
        $data = $req->body();

        $Data = json_decode($data, true);
        if (is_array($Data)) {
            try {
                $prestation_devi = new \partner\Prestationdevis();

                if (isset($Data['prestationId'])) {
                    $prestation_devi->setPrestationID($Data['prestationId']);
                }
                if (isset($Data['deviId'])) {
                    $prestation_devi->setDeviID($Data['deviId']);
                }
                if (isset($Data['quantite'])) {
                    $prestation_devi->setQuantite($Data['quantite']);
                }

                $prestation_devi->save();

                $jointureID = $prestation_devi->getPrestationdeviID();
                header('Content-type: application/json');
                echo "{ jointureID: $jointureID}";
                die();

            } catch (\Exception $e) {
                http_response_code(403);
                die();
            }
        }

        http_response_code(400);
        exit();

    }
});

$router->delete('/prestation_devis/[i:id]', function ($req) {
    $prestationdeviID = $req->id;
    if ($prestationdeviID > 0) {
        $prestationdevi = \partner\PrestationdevisQuery::create()
            ->findOneByPrestationdeviID($prestationdeviID);
        if ($prestationdevi != null) {
            $prestationdevi->delete();
            header('Content-type: application/json');
            echo '{"code": 200 }';
            die();
        } else
            echo '{"prestation data not found"}';

    }http_response_code(404);
    echo '{"prestationID incorrect"}';
    exit();

});

$router->get('/prestation_de_devis/[i:id]', function ($req) {
    $deviID = $req->id;
    if ($deviID > 0) {
        $PrestationDevis = \partner\PrestationdevisQuery::create()
            ->setFormatter('Propel\Runtime\Formatter\ArrayFormatter')
            ->joinWithPrestation()
            ->findByDeviID($deviID);

        if ($PrestationDevis != null) {
            header('Content-type: application/json');
            echo $PrestationDevis->toJSON();
            die();
        }else
            echo '{"prestation data not found"}';
    }
    http_response_code(404);
    echo '{"prestationID incorrect"}';
    exit();
});

$router->dispatch();