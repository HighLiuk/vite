# Example

## Install

```bash
composer install
cd client
npm install
npm run build
```

## Local development (frontend only)

```bash
cd client
npm run dev
open http://localhost:5173/
```

## Local development (embedded on PHP)

**Start the Vite server as described in the previous section**, then:

```bash
php -S localhost:8000 -t public
open http://localhost:8000/
```

Notice how **HMR works**: you can change the frontend code and see the changes immediately, without refreshing the page.
If you use React, Vue or some other frontend framework, you can see how state is also preserved while you edit the code.

## Test the production build

```bash
cd client
npm run build
cd ..
php -S localhost:8000 -t public
open http://localhost:8000/
```
