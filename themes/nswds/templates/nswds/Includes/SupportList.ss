<div class="nsw-support-list">

    <% if $SupportList_Header %>
        <h4 class="nsw-support-list__header">{$SupportList_Header}</h4>
    <% end_if %>

    <% if $Waratah_Masterbrand || $Waratah_CoBrand %>

        <%-- masterbrand and cobrand --%>

        <div class="nsw-support-list__container">

            <% if $SupportList_Labels %>
            <div class="nsw-support-list__gov-departments">
                <div>
                <p><%t nswds.SUPPORTLIST_NSW_GOVERNMENT 'NSW Government' %></p>
                <% include nswds/SupportList_Labels SupportList_Labels=$SupportList_Labels %>
                </div>
            </div>
            <% end_if %>

            <% include nswds/SupportList_Logos SupportList_Logos=$SupportList_Logos, SupportList_IncludeWaratah=0 %>

        </div>

    <% else %>

        <%-- endorsed, independent or standalone --%>

        <div class="nsw-support-list__container">

            <% if $SupportList_MasterBrandDescriptorLinks %>

                <div class="nsw-support-list__gov-departments">
                    <% include nswds/Waratah_SVG Waratah_Height=76 %>
                    <% include nswds/SupportList_Labels SupportList_Labels=$SupportList_Labels %>
                </div>
                <% include nswds/SupportList_Logos SupportList_Logos=$SupportList_Logos, SupportList_IncludeWaratah=0 %>

            <% else %>

                <%-- logos only --%>
                <% include nswds/SupportList_Logos SupportList_Logos=$SupportList_Logos, SupportList_IncludeWaratah=1 %>

            <% end_if %>

        </div>

    <% end_if %>


</div>
