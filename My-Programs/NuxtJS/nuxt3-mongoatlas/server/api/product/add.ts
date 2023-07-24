import { PrismaClient } from "@prisma/client";

export default defineEventHandler(async (event: any) => {
    const prisma = new PrismaClient();
    const req = await readBody(event);

    let desc: any = req.descriptions;
    let qty: any = req.qty;
    let unit: any = req.unit;
    let cost: any = req.cost_price;
    let sell: any = req.sell_price;
    let sale: any = req.sale_price;
    let alert: any = req.alert_level;
    let critical: any = req.critical_level;
    let prodpic: any = req.prod_pic;
    try {

        const description = await prisma.product.findUnique({
            where: {
              descriptions: desc,
            },
          })
          if (description !== null) {
            return { statuscode: 201,message: 'Description is taken.'};
          }

        await prisma.product.create({
            data: {
                descriptions: desc,
                qty: qty,
                unit: unit,
                cost_price: cost,
                sell_price: sell,
                sale_price: sale,
                alert_level: alert,
                critical_level: critical,
                prod_pic: prodpic
            }
        });
        return {statuscode: 200, message: "New products has been added."};
    } catch(e: any) {
        return {statuscode: 200, message: e.message};
    }    

});