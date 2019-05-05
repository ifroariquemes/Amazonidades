<?php

namespace App\Controller;

use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Cla;
use App\Entity\Membro;

class MembroController extends EasyAdminController {

    protected function createEntityFormBuilder($entity, $view) {
        $entity->setCla($this->randomizeCla());
        return parent::createEntityFormBuilder($entity, $view);
    }

    public function randomizeCla() {
        $clas = $this->getDoctrine()->getRepository(Cla::class)->countMembros();
        $clasRand = $clas;
        $totalClas = count($clas);
        for ($i = 0; $i < $totalClas; $i++) {
            foreach ($clas as $cla) {
                if ($clas[$i]['membros'] > $cla['membros']) {
                    unset($clasRand[$i]);
                    break;
                }
            }
        }
        $iRand = array_rand($clasRand);
        return $this->getDoctrine()->getRepository(Cla::class)->find($clasRand[$iRand]['id']);
    }

    /**
     * @Route("/admin/batch", name="app_batch")
     */
    public function batchRegister(Request $request) {
        if ($request->getMethod() == 'POST') {
            $em = $this->getDoctrine()->getManager();
            $arDados = explode("\n", $request->get('dados'));
            foreach ($arDados as $dado) {
                $dado = trim($dado);
                if (!empty($dado)) {
                    $membroRaw = explode(',', trim($dado));
                    $membro = new Membro();
                    $membro
                            ->setCla($this->randomizeCla())
                            ->setCpf(str_replace(['.','-'], '', $membroRaw[0]))
                            ->setNome($membroRaw[1]);
                    $em->persist($membro);
                    $em->flush();
                }
            }
        }
        return $this->render('admin/batch.html.twig');
    }

}
