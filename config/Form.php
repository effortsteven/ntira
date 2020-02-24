<?php
namespace Config;
use Symfony\Component\Form\Forms;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
class Form 
{

    public static function createForm($widgets = [],$defaults=[]){
        $formFactory = Forms::createFormFactory();
        $form = $formFactory->createBuilder(FormType::class, $defaults);
        foreach ($widgets as $key => $value) {
            $class = self::getFormType($value);
           $form->add($key,$class);
        }
        return  $form->getForm()->createView();

    } 


    private static function translateFormType($type_obj){
        return $type_obj->getBlockPrefix();
    }


    private static function getFormType($string){
        try {
            switch($string){
                case self::translateFormType(new TextType()):
                    return TextType::class;
                case self::translateFormType(new DateType()):
                    return DateType::class;
                case self::translateFormType(new EmailType()):
                    return EmailType::class;
                default:
                    throw new Exception("{$string} is not registered Type", 1); 
            }
        } catch (\Throwable $th) {
            die(var_dump($th->getMessage()));
        }
    } 
}
