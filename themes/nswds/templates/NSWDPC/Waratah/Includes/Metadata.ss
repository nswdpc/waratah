    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{$Title.XML} - {$SiteConfig.Title.XML}</title>
    <% if $Priority == "-1" %><meta name="robots" content="noindex, nofollow"><% end_if %>
    <% if $MetaDescription || $Abstract %><meta name="description" content="<% if $MetaDescription %>{$MetaDescription.XML}<% else %>{$Abstract.XML}<% end_if %>"><% end_if %>
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<% if $CurrentPage.InSection(home) %>{$BaseHref}<% else %>{$AbsoluteLink}<% end_if %>">
    <meta property="og:title" content="{$Title.XML}">
    <% if $MetaDescription || $Abstract %><meta property="og:description" content="<% if $MetaDescription %>{$MetaDescription.XML}<% else %>{$Abstract.XML}<% end_if %>"><% end_if %>
    <% if $Image %><meta property="og:image" content="{$Image.FocusFillMax(1200,630).AbsoluteLink}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630"><% end_if %>
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="{$SiteConfig.Title}<% if $SiteConfig.Tagline %> - {$SiteConfig.Tagline}<% end_if %>">
    <meta name="twitter:url" content="<% if $CurrentPage.InSection(home) %>{$BaseHref}<% else %>{$AbsoluteLink}<% end_if %>">
    <meta name="twitter:title" content="{$Title.XML}">
    <% if $MetaDescription || $Abstract %><meta name="twitter:description" content="<% if $MetaDescription %>{$MetaDescription.XML}<% else %>{$Abstract.XML}<% end_if %>"><% end_if %>
    <% if $Image %><meta name="twitter:image" content="{$Image.FocusFillMax(640,640).AbsoluteLink}"><% end_if %>
    <link rel="manifest" href="{$resourceURL('nswdpc/waratah:themes/nswds/app/static/site.webmanifest.json')}">
