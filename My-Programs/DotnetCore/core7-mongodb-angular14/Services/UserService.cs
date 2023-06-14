using MongoDB.Driver;
using core7_mongodb_angular14.Entities;
using Microsoft.Extensions.Options;
using core7_mongodb_angular14.Helpers;

namespace core7_mongodb_angular14.Services
{
    public interface IUserService {
        IEnumerable<User> GetAll();
        User GetById(string id);
        Boolean UpdateUser(User user);
        Boolean DeleteUser(string id);
        Boolean ActivateMfa(string id, bool opt, string qrcode_url);
        Boolean UpdatePicture(string id, string file);
    }
    public class UserService : IUserService
    {
        private readonly MongoDBContext _context;
        private readonly AppSettings _appSettings;
         IConfiguration config = new ConfigurationBuilder()
        .AddJsonFile("appsettings.json")
        .AddEnvironmentVariables()
        .Build();

        public UserService(
            MongoDBContext context, 
            IOptions<AppSettings> appSettings
            ) {
            _context = context;
            _appSettings = appSettings.Value;            
        }

        public bool ActivateMfa(string id, bool opt, string qrcode_url)
        {
            try {
                var filter = Builders<User>.Filter.Eq(s => s.Id, id);
                if (opt == true) {
                    var update = Builders<User>.Update
                            .Set(s => s.Qrcodeurl, qrcode_url)
                            .CurrentDate(s => s.Date_updated);
                    _context.Users.UpdateOne(filter, update);
                } else {
                    var update = Builders<User>.Update
                            .Set(s => s.Qrcodeurl, null)
                            .CurrentDate(s => s.Date_updated);
                    _context.Users.UpdateOne(filter, update);
                }
                return true;
            } catch(Exception) {
                throw new AppException("User ID not found, please register first...");
            }
        }

        public bool DeleteUser(string id)
        {
            try {
                User user = GetById(id);
                if (user is not null) {
                    _context.Users.DeleteOneAsync(Builders<User>.Filter.Eq("Id", id));
                    return true;
                } else {
                    return false;
                }
            } catch (Exception ex) {
                throw new AppException(ex.Message);
            }
        }

        public IEnumerable<User> GetAll()
        {
            try {
                List<User> usr = _context.Users.Find(_ => true).ToList();
                return usr;
            } catch(Exception ex) {
                    throw new AppException(ex.Message);
            }
        }

        public User GetById(String id)
        {
            try {
                List<User> usr = _context.Users.Find(x => x.Id == id).ToList();
                return usr.FirstOrDefault();
            } catch(Exception) {
                throw new AppException("User ID not found.");
            }
        }

        public bool UpdateUser(User user)
        {
            try {
                var filter = Builders<User>.Filter.Eq(s => s.Id, user.Id);
                if (user.Password is not null) {
                    var update = Builders<User>.Update
                            .Set(s => s.Lastname, user.Lastname)
                            .Set(s => s.Firstname, user.Firstname)
                            .Set(s => s.Mobile, user.Mobile)
                            .Set(s => s.Password, user.Password)
                            .CurrentDate(s => s.Date_updated);
                    _context.Users.UpdateOne(filter, update);
                } else {
                    var update = Builders<User>.Update
                            .Set(s => s.Lastname, user.Lastname)
                            .Set(s => s.Firstname, user.Firstname)
                            .Set(s => s.Mobile, user.Mobile)                            
                            .CurrentDate(s => s.Date_updated);
                    _context.Users.UpdateOne(filter, update);
                }
                return true;

            } catch(Exception) {
                throw new AppException("User ID not found, please register first...");
            }
        }

        public bool UpdatePicture(string id, string file)
        {
            try {
                var filter = Builders<User>.Filter.Eq(s => s.Id, id);
                var update = Builders<User>.Update
                        .Set(s => s.Profilepic, file)
                        .CurrentDate(s => s.Date_updated);
                _context.Users.UpdateOne(filter, update);
                return true;

            } catch(Exception) {
                throw new AppException("User ID not found, please register first...");
            }
        }
    }
}