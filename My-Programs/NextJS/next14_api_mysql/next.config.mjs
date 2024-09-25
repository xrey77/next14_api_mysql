/** @type {import('next').NextConfig} */
const nextConfig = {

    reactStrictMode: false,
    typescript: {
      ignoreBuildErrors: true,
    },
    serverRuntimeConfig: {
        connectionString: "mongodb+srv://vercel-admin-user:Reynalds88@cluster0.maowtb0.mongodb.net/Next13?retryWrites=true&w=majority",
        secret: '7bbc21c9826d9d54a4282aacbe9812f32a1dd1148d9be7246c7cecd7b3157b79c76144eea49b12bb4958db055e53a663d4695863ae73556abc47148d247b3830'
    },  
};

export default nextConfig;
