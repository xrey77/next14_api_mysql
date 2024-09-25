import { NextResponse, NextRequest } from "next/server";
import pool from "@/app/libs/mysql";

export async function GET() {

    return NextResponse.json({
        statuscode: 200,
        message: "Products has been retrieved."});
}

export async function POST(req: NextRequest) {
    const data = await req.json()

    try {
        const db = await pool.getConnection()
        const query = 'select * from account'
        const [rows] = await db.execute(query)
        db.release()
        
        return NextResponse.json(rows)
    } catch (error) {
        return NextResponse.json({
            error: error
        }, { status: 500 })
    }

    return NextResponse.json({
        statuscode: 200,
        message: "New products has been added.",
        data
    });
}