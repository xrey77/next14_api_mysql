using Microsoft.AspNetCore.Mvc;
using core7_mongodb_angular14.Services;
using core7_mongodb_angular14.Models;
using core7_mongodb_angular14.Helpers;
using core7_mongodb_angular14.Entities;

namespace core7_mongodb_angular14.Controllers.Auth
{
    [ApiController]
    [Route("[controller]")]
    public class Signup: ControllerBase 
    {
        private readonly IAuthService _authService;
        private readonly ILogger<Signup> _logger;

        public Signup(
            IAuthService authService,
            ILogger<Signup> logger) 
            {
                _authService = authService;
                _logger = logger;            
            }

        [HttpPost("/signup")]
        public IActionResult signup(UserModel model)
        {
            try 
            {
                User user = new User();
                user.Lastname = model.Lastname;
                user.Firstname = model.Firstname;
                user.Email = model.Email;
                user.Mobile = model.Mobile;
                user.Username = model.Username;
                user.Isactivated = 0;
                user.Isblocked = 0;
                user.Mailtoken = 0;
                _authService.SignupUser(user, model.Password);
                return Ok(new {statuscode = 200, message = "You have registered successfully."});
            }
            catch (AppException ex)
            {
                return Ok(new { statuscode = 404, message = ex.Message });
            }
       }
    }   
}