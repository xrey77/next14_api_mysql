using core7_mongodb_angular14.Services;
using Microsoft.AspNetCore.Mvc;
using Microsoft.Extensions.Options;
using core7_mongodb_angular14.Helpers;
using Microsoft.AspNetCore.Authorization;

namespace core7_mongodb_angular14.Controllers.Users
{
    [Authorize]
    [ApiController]
    [Route("[controller]")]
    public class Deleteuser : ControllerBase {

        private readonly IUserService _usersService;
        private readonly ILogger<Deleteuser> _logger;
        private readonly IConfiguration _configuration;  

        public Deleteuser(
            IConfiguration configuration,
            IUserService usersService,
            ILogger<Deleteuser> logger,
            IOptions<AppSettings> appSettings) {
                _configuration = configuration;                
                _usersService = usersService;
                _logger = logger;            
        }

        [HttpDelete("/api/deleteuser/{id}")]
        public IActionResult Delete(string id)
        {
            try
            {
               bool res =  _usersService.DeleteUser(id);
               if (res) {
                    return Ok(new {statuscode = 200, message = "User is deleted successfully."});
               } else {
                    return NotFound(new {statuscode = 404, message = "User Id not found."});
               }
           }
            catch (Exception ex)
            {
                return NotFound(new { statuscode = 404, message = ex.Message });
            }
            
        }    
    }    
}