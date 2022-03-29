<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   (C) 2022 Brian Teeman <https://www.learnjoomla4.com>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\FileLayout;
use Joomla\CMS\Layout\LayoutHelper;

$app = Factory::getApplication();

$this->category->text = $this->category->description;
$app->triggerEvent('onContentPrepare', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$this->category->description = $this->category->text;

$results = $app->triggerEvent('onContentAfterTitle', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$afterDisplayTitle = trim(implode("\n", $results));

$results = $app->triggerEvent('onContentBeforeDisplay', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$beforeDisplayContent = trim(implode("\n", $results));

$results = $app->triggerEvent('onContentAfterDisplay', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$afterDisplayContent = trim(implode("\n", $results));

$htag    = $this->params->get('show_page_heading') ? 'h2' : 'h1';

?>
<div class="com-content-category-card mb-4" itemscope itemtype="https://schema.org/Blog">
	<?php if ($this->params->get('show_page_heading')) : ?>
		<div class="page-header">
			<h1> <?php echo $this->escape($this->params->get('page_heading')); ?> </h1>
		</div>
	<?php endif; ?>

	<?php if ($this->params->get('show_category_title', 1)) : ?>
	<<?php echo $htag; ?>>
		<?php echo $this->category->title; ?>
	</<?php echo $htag; ?>>
	<?php endif; ?>
	<?php echo $afterDisplayTitle; ?>

	<?php if ($beforeDisplayContent || $afterDisplayContent || $this->params->get('show_description', 1) || $this->params->def('show_description_image', 1)) : ?>
		<div class="category-desc clearfix">
			<?php if ($this->params->get('show_description_image') && $this->category->getParams()->get('image')) : ?>
				<?php echo LayoutHelper::render(
					'joomla.html.image',
					[
						'src' => $this->category->getParams()->get('image'),
						'alt' => empty($this->category->getParams()->get('image_alt')) && empty($this->category->getParams()->get('image_alt_empty')) ? false : $this->category->getParams()->get('image_alt'),
					]
				); ?>
			<?php endif; ?>
			<?php echo $beforeDisplayContent; ?>
			<?php if ($this->params->get('show_description') && $this->category->description) : ?>
				<?php echo HTMLHelper::_('content.prepare', $this->category->description, '', 'com_content.category'); ?>
			<?php endif; ?>
			<?php echo $afterDisplayContent; ?>
		</div>
	<?php endif; ?>

	<?php if (empty($this->intro_items)) : ?>
		<div class="alert alert-info">
			<span class="icon-info-circle" aria-hidden="true"></span>
			<span class="visually-hidden"><?php echo Text::_('INFO'); ?></span>
			<?php echo Text::_('COM_CONTENT_NO_ARTICLES'); ?>
		</div>
	<?php endif; ?>

	<?php if (!empty($this->intro_items)) : ?>
		<div class="row row-cols-1 row-cols-md-2 row-cols-lg-<?php echo $this->params->get('num_columns'); ?> g-4">
			<?php foreach ($this->intro_items as $key => &$item) : ?>
				<div class="col">
				<?php $this->item = & $item; ?>
				<?php echo $this->loadTemplate($this->params->get('card_type')); ?>
				</div>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
</div>






