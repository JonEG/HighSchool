<?php

declare (strict_types = 1);

namespace OvanGmbh\ClassYear\Preview;

use TYPO3\CMS\Backend\Preview\PreviewRendererInterface;
use TYPO3\CMS\Backend\View\BackendLayout\Grid\GridColumnItem;

class RandomImagePreviewRenderer implements PreviewRendererInterface
{

 public function renderPageModulePreviewHeader(GridColumnItem $item): string
 {
  return '<p><b>Random Image</b></p>';
 }

 public function renderPageModulePreviewContent(GridColumnItem $item): string
 {
  $record = $item->getRecord();

  if ($record['tx_classyear_random_image_url']) {
   $element = sprintf('<img src="%1$s" style="width:25%%"/>',
    $record['tx_classyear_random_image_url']
   );
   return $element;
  }
 }

 public function renderPageModulePreviewFooter(GridColumnItem $item): string
 {
  return 'This preview is 75% smaller than final image';
 }

 public function wrapPageModulePreview(string $previewHeader, string $previewContent, GridColumnItem $item): string
 {
  return sprintf(
   '<div>
    %1$s
    %2$s
    </div>',
   $previewHeader,
   $previewContent,
  );
 }

}
