import { PrismaClient } from "@prisma/client";

export default defineEventHandler(async (event: any) => {
    const prisma = new PrismaClient();
    const query = getQuery(event);
    try {
        const response = await prisma.product.findMany();
        let perpage: any = 5;
        let totrecs: any = response.length;
        let totpage: any = Math.ceil(totrecs / perpage);
        let page: any = query?.page;
        let offset: any = (page -1) * perpage;
        console.log(totpage);
        const products = await prisma.product.findMany({
            skip: offset,
            take: perpage
        });
        return {totpages: totpage, page: parseInt(page), products: products};

    } catch(e: any) {
        return {statuscode: 404, message: e.message};
    }    
});