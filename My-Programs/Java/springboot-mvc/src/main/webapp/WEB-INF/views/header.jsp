<%@ page session="true" %>
<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<%@taglib uri="http://www.springframework.org/tags" prefix="spring"%>
<%@taglib uri="http://java.sun.com/jsp/jstl/core" prefix="c"%>    
    
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Rydiam Saigon Co. Ltd.</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
<link rel="stylesheet" type="text/css" href="<spring:url value="/css/rydiam.css" />">
<script src="<spring:url value="/js/rydiam.js" />" type="text/javascript"></script>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light hdr-bg">
  <div class="container-fluid">
    <a class="navbar-brand" href="<spring:url value="/home" />"><img src="<spring:url value="/images/logo2.png" />" style="width:180px;height:40px;"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active lnk-title" aria-current="page" href="<spring:url value="/aboutus" />">About Us</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle lnk-title" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Services
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item lnk-title" href="<spring:url value="/retails" />">Retails</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item lnk-title" href="<spring:url value="/cuttings" />">Cutting</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item lnk-title" href="<spring:url value="/repairs" />">Repairs</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link lnk-title" href="<spring:url value="/contactus" />">Contact Us</a>
        </li>
      </ul>
      <ul class="navbar-nav  mb-2 mr-auto">
	<c:choose>
	<c:when test="${sessionScope.USERNAME == null}">
      
        <li class="nav-item">
          <a id="xlogin" class="nav-link lnk-title" href="#">LogIn</a>
        </li>
        <li class="nav-item">
          <a id="xregister" class="nav-link lnk-title" href="#">Register</a>
        </li>
 	</c:when>
 	<c:otherwise>        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle lnk-title" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <c:out value="${sessionScope.USERNAME}" />
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item lnk-title" href="<spring:url value="/signout" />">LogOut</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item lnk-title" href="<spring:url value="/profile" />">Profile</a></li>
          </ul>
        </li>
        
        
         	
 	</c:otherwise>
 	</c:choose>
 	
 	
	


      
      </ul>
    </div>
  </div>
</nav>
<script src="<spring:url value="/js/jquery-3.5.1.js" />" type="text/javascript"></script>
<%@ include file="login.jsp" %>      
<%@ include file="register.jsp" %>		
</body>
</html>