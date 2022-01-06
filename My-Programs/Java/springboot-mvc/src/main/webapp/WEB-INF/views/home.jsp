<%@taglib uri="http://www.springframework.org/tags" prefix="spring"%>
    
 <%@ include file="header.jsp" %>
 <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 3"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="<spring:url value="/images/pic1.jpg" />" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="<spring:url value="/images/pic2.jpg" />" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="<spring:url value="/images/pic3.jpg" />" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="<spring:url value="/images/pic4.jpg" />" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="<spring:url value="/images/pic5.jpg" />" class="d-block w-100" alt="...">
    </div>    
  </div>
</div>
<div class="container-fluid">
    <h4>Diamond Processing</h4>
    <p class="lead text-justify" style="font-size:14px;">To the non-professional, an unpolished rough diamond appears to be very much like a dull piece of glass. Only when it is polished and facetted, it ascends to its full glory, displaying the sparkling brightness and splash of colours for which it is famous. From the time the diamond is transformed from a rough stone into a gem set in an item of jewellery, it has lost half of its weight. Before the cutting and polishing process begins, a thorough examination of the rough diamond is conducted. We can distinguish 4 different phases in diamond processing: drawing/marking, cleaving/sawing, bruiting and polishing.</p>
    <p class="lead text-justify">&nbsp;</p>
</div>





 <%@ include file="footer.jsp" %>
 
 
 