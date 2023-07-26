<% if $SitewideNotice %>

    <% with $SitewideNotice %>

        <% include NSWDPC/Waratah/Modal Modal_ModalID=$ModalId, Modal_ExtraClass=$ExtraClass, Modal_ShowOnLoad='1', Modal_AutoCloseAfter=$AutoCloseAfter, Modal_Title=$Title, Modal_ShowTitle=$ShowTitle, Modal_Content=$Description %>

    <% end_with %>

<% end_if %>

<% if $NoticeID %>

    <% include NSWDPC/Waratah/Modal Modal_ModalID=$NoticeID, Modal_ExtraClass=$Notice.ExtraClass, Modal_ShowOnLoad='1', Modal_AutoCloseAfter=$Notice.AutoCloseAfter, Modal_Title=$Notice.Title, Modal_ShowTitle=$Notice.ShowTitle, Modal_Content=$Notice.Description, Modal_Link=$Notice.Link, Modal_Image=$Notice.Image %>

<% end_if %>
