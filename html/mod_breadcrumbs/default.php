<?php
/**
 * @package     SEO Overrides
 * @subpackage  com_content
 * @author		Robert Went http://www.robertwent.com
 * @copyright   Copyright (C) 2013 - Robert Went
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$app = JFactory::getApplication();
$template = $app->getTemplate();
include (JPATH_BASE.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.$template.DIRECTORY_SEPARATOR.'pure'.DIRECTORY_SEPARATOR.'config.php');

//JHtml::_('bootstrap.tooltip');

?>
<nav>
	<ul class="breadcrumb<?php echo $moduleclass_sfx; ?>">
		<?php
		if ($params->get('showHere', 1))
		{
			echo '<li class="active"><span class="divider icon-location hasTooltip" title="' . JText::_('MOD_BREADCRUMBS_HERE') . '"></span></li>';
		}

	// Get rid of duplicated entries on trail including home page when using multilanguage
		for ($i = 0; $i < $count; $i++)
		{
			if ($i == 1 && !empty($list[$i]->link) && !empty($list[$i - 1]->link) && $list[$i]->link == $list[$i - 1]->link)
			{
				unset($list[$i]);
			}
		}

	// Find last and penultimate items in breadcrumbs list
		end($list);
		$last_item_key = key($list);
		prev($list);
		$penult_item_key = key($list);

	// Generate the trail
		foreach ($list as $key => $item) :
	// Make a link if not the last item in the breadcrumbs
			$show_last = $params->get('showLast', 1);
		if ($key != $last_item_key)
		{
		// Render all but last item - along with separator
			if ($microBread) {
				echo '<li  itemscope itemtype="http://data-vocabulary.org/Breadcrumb">';
				if (!empty($item->link))
				{
					echo '<a href="' . $item->link . '" class="pathway" itemprop="url"><span itemprop="title">' . $item->name . '</span></a>';
				}
				else
				{
					echo '<span>' . $item->name . '</span>';
				}
			} else {
				echo '<li>';
				if (!empty($item->link))
				{
					echo '<a href="' . $item->link . '" class="pathway">' . $item->name . '</a>';
				}
				else
				{
					echo '<span>' . $item->name . '</span>';
				}
			}

			if (($key != $penult_item_key) || $show_last)
			{
				echo '<span class="divider">' . $separator . '</span>';
			}

			echo '</li>';
		}
		elseif ($show_last)
		{
		// Render last item if reqd.
			echo '<li>';
			echo '<span>' . $item->name . '</span>';
			echo '</li>';
		}
		endforeach; ?>
	</ul>
</nav>
