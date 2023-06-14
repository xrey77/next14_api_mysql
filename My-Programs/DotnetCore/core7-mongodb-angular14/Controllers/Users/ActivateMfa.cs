using core7_mongodb_angular14.Helpers;
using core7_mongodb_angular14.Models;
using core7_mongodb_angular14.Services;
using Microsoft.AspNetCore.Mvc;
using Microsoft.Extensions.Options;
using Google.Authenticator;
using core7_mongodb_angular14.Entities;

namespace core7_mongodb_angular14.Controllers.Users
{
    public class ActivateMfa : ControllerBase {

        private readonly IUserService _usersService;
        private readonly ILogger<ActivateMfa> _logger;
        private readonly IConfiguration _configuration;  

        public ActivateMfa(
            IConfiguration configuration,
            IUserService usersService,
            ILogger<ActivateMfa> logger,
            IOptions<AppSettings> appSettings) {
                _configuration = configuration;                
                _usersService = usersService;
                _logger = logger;            
        }


        [HttpPut("/api/enablemfa/{id}")]
        public IActionResult EnableMFA(string id,[FromBody]MfaModel model) {
            if (model.Twofactorenabled == true) {
                User user = _usersService.GetById(id);
                if(user is not null) {
                    QRCode qrimageurl = new QRCode();
                    var fullname = user.Firstname + " " + user.Lastname;
                    TwoFactorAuthenticator twoFactor = new TwoFactorAuthenticator();
                    var setupInfo = twoFactor.GenerateSetupCode(fullname, user.Email, user.Secretkey, false, 3);
                    var imageUrl = setupInfo.QrCodeSetupImageUrl;
                    _usersService.ActivateMfa(id, true, imageUrl);
                    return Ok(new {statuscode = 200, message="2-Factor Authenticator has been enabled."});
                } else {
                    return Ok(new {statuscode = 404, message="User not found."});
                }
            } else {
                _usersService.ActivateMfa(id, false, null);
                return Ok(new {statuscode = 200, message="2-Factor Authenticator has been disabled."});
            }
        }

    }
}