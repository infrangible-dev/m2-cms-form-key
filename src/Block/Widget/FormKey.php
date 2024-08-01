<?php

declare(strict_types=1);

namespace Infrangible\CmsFormKey\Block\Widget;

use Magento\Framework\App\Response\Http;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\View\Element\AbstractBlock;
use Magento\Framework\View\Element\Template\Context;
use Magento\Widget\Block\BlockInterface;

/**
 * @author      Andreas Knollmann
 * @copyright   2014-2024 Softwareentwicklung Andreas Knollmann
 * @license     http://www.opensource.org/licenses/mit-license.php MIT
 */
class FormKey
    extends AbstractBlock
    implements BlockInterface
{
    /** @var \Magento\Framework\Data\Form\FormKey */
    protected $formKey;

    /** @var ResponseInterface */
    protected $response;

    public function __construct(
        Context $context,
        \Magento\Framework\Data\Form\FormKey $formKey,
        ResponseInterface $response,
        array $data = [])
    {
        parent::__construct($context, $data);

        $this->formKey = $formKey;
        $this->response = $response;
    }

    /**
     * @throws LocalizedException
     */
    public function getFormKey(): string
    {
        return $this->formKey->getFormKey();
    }

    /**
     * @throws LocalizedException
     */
    protected function _toHtml(): string
    {
        return '<input name="form_key" type="hidden" value="' . $this->getFormKey() . '" />';
    }

    protected function _afterToHtml($html): string
    {
        if ($this->response instanceof Http) {
            $this->response->setNoCacheHeaders();
        }

        return parent::_afterToHtml($html);
    }
}
