using Microsoft.AspNetCore.Mvc;
// using core7_mongodb_angular14.Services;
using core7_mongodb_angular14.Entities;
using core7_mongodb_angular14.Services;
using Microsoft.Extensions.Options;
using core7_mongodb_angular14.Helpers;
using core7_mongodb_angular14.Models;
using Microsoft.AspNetCore.Authorization;

namespace core7_mongodb_angular14.Controllers.Users
{
    [Authorize]
    [ApiController]
    [Route("[controller]")]
    public class Updateuser : ControllerBase {
        private readonly IUserService _usersService;
        private readonly ILogger<Updateuser> _logger;
        private readonly IConfiguration _configuration;  

        public Updateuser(
            IConfiguration configuration,
            IUserService usersService,
            ILogger<Updateuser> logger,
            IOptions<AppSettings> appSettings) {
                _configuration = configuration;                
                _usersService = usersService;
                _logger = logger;            
        }

        [HttpPost("/api/updateprofile/{id}")]
        public IActionResult Update(string id,[FromBody]UserUpdate model)
        {
            try {
            User user = new User();
            user.Id = id;
            user.Lastname = model.Lastname;
            user.Firstname = model.Firstname;
            user.Mobile = model.Mobile;
            if (model.Password is not null) {
                user.Password =  BCrypt.Net.BCrypt.HashPassword(model.Password);
            } else {
                user.Password = null;
            }
            _usersService.UpdateUser(user);
            return Ok(new {statuscode = 200, message = "User Profile updated successfully."});
            } catch(Exception ex) {
                return NotFound(new { statuscode = 500, ex.Message});
            }
        }
    }    
}