<?php

namespace AppBundle\Form\Extension;

use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\HttpFoundation\RequestStack;

class DisableCSRFExtensionForRestApi extends AbstractTypeExtension
{
    /**
     * @var RequestStack
     */
    private $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        if (!$this->isApi()) {
            /**
             * THIS IS NOT REQUIRED TO REPRODUCE THE BUG!
             *
             * It just prevents you from getting "Notice: Undefined index: csrf_protection" in tests
             * if you comment the line "'csrf_protection' => $this->defaultEnabled," in
             * vendor/symfony/symfony/src/Symfony/Component/Form/Extension/Csrf/Type/FormTypeCsrfExtension.php
             */
            $resolver->setDefaults([
                'csrf_protection' => true,
            ]);

            return;
        }

        $resolver->setDefaults([
            'csrf_protection' => false,
        ]);
    }

    /**
     * @return string
     */
    public function getExtendedType()
    {
        return FormType::class;
    }

    private function isApi()
    {
        return ($this->requestStack->getCurrentRequest()->getPathInfo() === '/no-csrf');
    }
}
