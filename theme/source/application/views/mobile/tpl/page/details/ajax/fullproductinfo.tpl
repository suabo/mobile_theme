[{assign var="oDetailsProduct" value=$oView->getProduct()}]
[{assign var="currency" value=$oView->getActCurrency()}]
[{assign var="oPictureProduct" value=$oView->getPicturesProduct()}]

[{oxscript add="$( '#variants' ).oxArticleVariant();"}]
[{include file="page/details/inc/fullproductinfo.tpl"}]
[{oxscript add="$( 'div.dropdown' ).oxDropDown();"}]
[{oxscript}]
