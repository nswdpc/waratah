<li class="nsw-carousel__item">
<%-- some values come from the parent context --%>
<% include nswds/Card Card_Carousel=1, Card_Title=$Title, Card_Content=$Content, Card_Image=$Image, Card_ImageWidth=$ThumbWidth, Card_ImageHeight=$ThumbHeight, Card_LinkURL=$DerivedLink.LinkURL, Card_LinkOpenInNewWindow=$DerivedLink.OpenInNewWindow %>
</li>
