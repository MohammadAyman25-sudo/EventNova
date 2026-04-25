<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // ── Permission definitions ─────────────────────────────────────────────
        // Each entry is: 'permission-slug' => ['organizer' => bool, 'attendee' => bool]
        $permissions = [

            // ── Events ────────────────────────────────────────────────────────
            'events.view-any'           => ['organizer' => true,  'attendee' => true],   // browse published events
            'events.view-own'           => ['organizer' => true,  'attendee' => false],  // see own draft/unpublished
            'events.create'             => ['organizer' => true,  'attendee' => false],
            'events.edit-own'           => ['organizer' => true,  'attendee' => false],
            'events.delete-own'         => ['organizer' => true,  'attendee' => false],
            'events.publish-own'        => ['organizer' => true,  'attendee' => false],  // draft → published
            'events.cancel-own'         => ['organizer' => true,  'attendee' => false],  // published → cancelled
            'events.duplicate-own'      => ['organizer' => true,  'attendee' => false],  // clone an event
            'events.export-attendees'   => ['organizer' => true,  'attendee' => false],  // CSV/Excel export

            // ── Ticket types ──────────────────────────────────────────────────
            'ticket-types.view-own'     => ['organizer' => true,  'attendee' => false],
            'ticket-types.create'       => ['organizer' => true,  'attendee' => false],
            'ticket-types.edit-own'     => ['organizer' => true,  'attendee' => false],
            'ticket-types.delete-own'   => ['organizer' => true,  'attendee' => false],

            // ── Orders ────────────────────────────────────────────────────────
            'orders.view-own'           => ['organizer' => true,  'attendee' => true],   // organizer sees event orders; attendee sees their purchases
            'orders.create'             => ['organizer' => false, 'attendee' => true],   // place an order / buy a ticket
            'orders.cancel-own'         => ['organizer' => false, 'attendee' => true],   // attendee cancels their order

            // ── Payments ──────────────────────────────────────────────────────
            'payments.view-own'         => ['organizer' => true,  'attendee' => true],   // organizer: revenue; attendee: receipts
            'payments.request-refund'   => ['organizer' => false, 'attendee' => true],   // attendee requests refund
            'payments.process-refund'   => ['organizer' => true,  'attendee' => false],  // organizer approves / processes refund

            // ── Coupons ───────────────────────────────────────────────────────
            'coupons.view-own'          => ['organizer' => true,  'attendee' => false],
            'coupons.create'            => ['organizer' => true,  'attendee' => false],
            'coupons.edit-own'          => ['organizer' => true,  'attendee' => false],
            'coupons.delete-own'        => ['organizer' => true,  'attendee' => false],
            'coupons.apply'             => ['organizer' => false, 'attendee' => true],   // redeem a coupon at checkout

            // ── Attendee check-in ─────────────────────────────────────────────
            'check-in.scan'             => ['organizer' => true,  'attendee' => false],  // scan QR / mark attendance
            'check-in.view-list'        => ['organizer' => true,  'attendee' => false],  // see attendee list for own event

            // ── Registrations / tickets (attendee-side) ───────────────────────
            'registrations.view-own'    => ['organizer' => false, 'attendee' => true],   // my tickets / registrations
            'registrations.download'    => ['organizer' => false, 'attendee' => true],   // download ticket PDF / QR

            // ── Reviews & ratings ─────────────────────────────────────────────
            'reviews.create'            => ['organizer' => false, 'attendee' => true],   // leave a review after attending
            'reviews.edit-own'          => ['organizer' => false, 'attendee' => true],
            'reviews.delete-own'        => ['organizer' => false, 'attendee' => true],
            'reviews.respond-own'       => ['organizer' => true,  'attendee' => false],  // organizer replies to a review

            // ── Saved / wishlist events ───────────────────────────────────────
            'events.save'               => ['organizer' => false, 'attendee' => true],   // bookmark an event
            'events.unsave'             => ['organizer' => false, 'attendee' => true],

            // ── Notifications ─────────────────────────────────────────────────
            'notifications.view-own'    => ['organizer' => true,  'attendee' => true],
            'notifications.manage-own'  => ['organizer' => true,  'attendee' => true],   // update notification preferences

            // ── Profile ───────────────────────────────────────────────────────
            'profile.view-own'          => ['organizer' => true,  'attendee' => true],
            'profile.edit-own'          => ['organizer' => true,  'attendee' => true],

            // ── Organizer dashboard / analytics ──────────────────────────────
            'analytics.view-own'        => ['organizer' => true,  'attendee' => false],  // revenue, ticket sales charts

            // ── Payouts (organizer receives earnings) ─────────────────────────
            'payouts.view-own'          => ['organizer' => true,  'attendee' => false],
            'payouts.request'           => ['organizer' => true,  'attendee' => false],  // request a payout

        ];

        // ── Upsert all permissions ────────────────────────────────────────────
        foreach (array_keys($permissions) as $slug) {
            Permission::firstOrCreate(['name' => $slug]);
        }

        // ── Upsert roles ──────────────────────────────────────────────────────
        $organizer = Role::firstOrCreate(['name' => 'organizer']);
        $attendee  = Role::firstOrCreate(['name' => 'attendee']);

        // ── Assign permissions ────────────────────────────────────────────────
        $organizerPerms = array_keys(array_filter($permissions, fn ($r) => $r['organizer']));
        $attendeePerms  = array_keys(array_filter($permissions, fn ($r) => $r['attendee']));

        $organizer->syncPermissions($organizerPerms);
        $attendee->syncPermissions($attendeePerms);

        // ── Super-admin (uncomment when needed) ───────────────────────────────
        // $superAdmin = Role::firstOrCreate(['name' => 'super-admin']);
        // $superAdmin->syncPermissions(Permission::all());
    }
}
