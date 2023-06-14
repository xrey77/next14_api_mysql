using AutoMapper;
using core7_mongodb_angular14.Entities;
using core7_mongodb_angular14.Models;

namespace core7_mongodb_angular14.Helpers
{
    public class AutoMapperProfile : Profile
    {
        public AutoMapperProfile()
        {
            CreateMap<User, UserModel>();
            CreateMap<UserRegister, User>();
            // CreateMap<UserLogin, User>();
            // CreateMap<UserUpdate, User>();
            // CreateMap<Product, ProductModel>();
        }
    }
}