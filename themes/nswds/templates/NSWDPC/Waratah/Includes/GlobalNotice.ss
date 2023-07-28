<% if $PageNoticeID %>

    <% include NSWDPC/Waratah/Modal Modal_ModalID=$CurrentPage.ID, Modal_ExtraClass=$PageNotice.ExtraClass, Modal_ShowOnLoad='1', Modal_AutoCloseAfter=$PageNotice.AutoCloseAfter, Modal_Title=$PageNotice.Title, Modal_ShowTitle=$PageNotice.ShowTitle, Modal_Content=$PageNotice.Description, Modal_Link=$PageNotice.Link, Modal_Image=$PageNotice.Image %>

<% else_if $SitewideNotice %>

    <% with $SitewideNotice %>

        <% include NSWDPC/Waratah/Modal Modal_ModalID=$ModalId, Modal_ExtraClass=$ExtraClass, Modal_ShowOnLoad='1', Modal_AutoCloseAfter=$AutoCloseAfter, Modal_Title=$Title, Modal_ShowTitle=$ShowTitle, Modal_Content=$Description %>

    <% end_with %>

<% end_if %>

