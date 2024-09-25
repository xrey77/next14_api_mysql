import pool from "@/app/libs/mysql";
import { NextRequest, NextResponse } from "next/server";
import speakeasy from 'speakeasy';
import QRCode from "qrcode";


export async function PATCH(req: NextRequest, ctx: any) {
    const data = await req.json();
    const {params} = ctx;
    let uid = parseInt(params.idNo,10);

    if (data.isactivate === true) {

            const secret =speakeasy.generateSecret({
                name: data.fullname,        
            });

            QRCode.toDataURL(secret.otpauth_url || '', async function(err: any,data: any) {

                try {
                    const db = await pool.getConnection()
                    await db.query('UPDATE account SET qrcode = ?, secretkey = ? WHERE id = ?', [secret.otpauth_url, secret.base32, uid]);
                    db.release()
                
                } catch (error) {
                    return NextResponse.json({
                        error: error
                    }, { status: 500})
                }    

            });

            return NextResponse.json({
                status: 200,
                message: "2-Factor Authenticator has been activated."
            });    



    } else {

        try {
            const db = await pool.getConnection()
            await db.query('UPDATE account SET qrcode = ?, secretkey = ? WHERE id = ?', [null, null, uid]);
            db.release()
                return NextResponse.json({
                    status: 200,
                    message: "2-Factor Authenticator has been de-activated."
                });    
        
        } catch (error) {
            return NextResponse.json({
                error: error
            }, { status: 500})
        }    

    }





}