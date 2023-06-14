namespace core7_mongodb_angular14.Controllers.Models
{
    public class ProductModel {
        public string Descriptions { get; set; }
        public int Qty { get; set; }
        public string Unit { get; set; }
        public decimal Cost_price { get; set; }
        public decimal Sell_price { get; set; }
        public string Category { get; set; }
        public decimal Sale_price { get; set; }
        public int Alert_level { get; set; }
        public int Critical_level { get; set; }        
        public string Prod_pic { get; set; }
        public DateTime Date_updated { get; set; }
    }
    
}