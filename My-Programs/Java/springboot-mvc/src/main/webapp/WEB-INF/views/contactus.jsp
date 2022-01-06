<%@taglib uri="http://www.springframework.org/tags" prefix="spring"%>    
 <%@ include file="header.jsp" %>

<div class="card mb-3">
  <img src="/images/contactus.jpg" class="card-img-top" alt="..." style="height:80%;object-fit: cover;">
  <div class="card-body" style="margin-bottom:50px;bottom:50px;">
    <h5 class="card-title">Contact Us</h5>
    <p class="card-text">Please fill up the form below, and we will get back to you asap.</p>

	<form class="w-50" method="POST">
	  <div class="form-group">
	    <label for="fullname">Your Full Name</label>
	    <input type="text" class="form-control" id="fullname" required>
	  </div>
	
	  <div class="form-group">
	    <label for="emailadd" class="mt-1">Email address</label>
	    <input type="email" class="form-control" id="emailadd" aria-describedby="emailHelp" required>
	  </div>
	  <div class="form-group">
	    <label for="message" class="mt-1">Your Message</label>
	    <textarea class="form-control" id="message" row="3" required></textarea>
	  </div>
	  <button type="submit" class="btn btn-info mt-2">Submit</button>
	</form>    
    
  </div>
</div>
 
 <%@ include file="footer.jsp" %>
 