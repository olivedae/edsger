# Mini World Description

> An informal way for describing Hooked so a schema can come a roll'n

### Users

- Users have the option of having an account or not having an account (non-account users will be restricted in access or available features of Hooked - more to come about this)

- Users with an account can consist of personal information such as a first and a last name, an email address, a password hash, an icon, the date they joined, and if their email has been confirmed.

- Users can search for routes given various forms of specifications for the search.

- Users can have their previous searches stored as history for usage.

- Users (w/ account) after building a route can star/favourite it in addition organise them into boxes that can contain 0 or more routes for quick access and grouping.

- Users (w/ account) can share a route with zero or many other people. Other people are not required to have an account with Hooked to view the route(s) or update them.

- Users (w/ account) can integrate Hooked with Apple Maps or Google Maps (or in general other map apps that they usually use, however these are all that come to mind).

- Users (w/ account) can chose that after a specified period of time of inactivity with a route that they no longer want to be sent updates for that route. If they enable this option they will be sent a notification reminding them that update notifications will be suppressed. A route however will not be set to unwatched. Once a user visits the route again notifications for that route will be unsuppressed. 

- Users (w/ account) can store addresses with a meaningful name for quick access. For example, their apartment can be named as `Home`. These saved locations will consist of a given name (by the user) and an address.


### Boxes

- Previously mentioned boxes will consist of a name, an icon, the date created, and also new updates to the routes stored in itself (routes can also maintain updates for new walks when they occur).

- Boxes and routes will also keep track of the last visited and updated time.

- All routes that are not manually put into a box are automatically placed in the General (can go by other names such as `Default`) box.


### Routes

- Routes can be configured to notify a user when the newest update occurs. Updates can also be configured for boxes in general which will notify users of all route updates unless configured otherwise for a specific route. This can be known as watching a route. Once stared, a user automatically watches a route.

- A route consists of one or multiple locations a user wishes to visit. These routes may be displayed or calculated once the user wishes to transverse a portion of/the whole route or view or similarly view a portion of or the entire route. A route can also consist of a name, the date created, the date it was last updated, and if it was favourite or watched by the user. Additional information about the route consists its total length, the estimated time for travel, and the remain time left which can (possibly?) be derived from the database.

- Routes (such as those with multiple locations) consist of sub-routes known as walks that join location A to location B. Thus, routes are derived.

- Routes can consist of what walk/location the user is at of the route.

- Previously searched locations, address specific, can derive how many times it’s been included in a route for a user.


### Route/Walk Cache

- Cache of previous routes and walks? Seems like it requires a more technical understanding of how we’ll be using Google API
