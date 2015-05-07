package com.example.gcm;

import android.app.IntentService;
import android.app.admin.DevicePolicyManager;
import android.content.ComponentName;
import android.content.Context;
import android.content.Intent;
import android.os.Build;
import android.os.Bundle;

import com.google.android.gms.gcm.GoogleCloudMessaging;
import com.myr.otros.Util;

public class GCMIntentService extends IntentService {

	public GCMIntentService() {
		super(YOUR_PROJECT_ID);
	}

	@Override
	protected void onHandleIntent(Intent intent) {
		GoogleCloudMessaging gcm = GoogleCloudMessaging.getInstance(this);

		String messageType = gcm.getMessageType(intent);
		Bundle extras = intent.getExtras();

		if (!extras.isEmpty()) {
			if (GoogleCloudMessaging.MESSAGE_TYPE_MESSAGE.equals(messageType)) {

				int id = Integer.parseInt(extras.getString("id"));
				String message = extras.getString("message");

        /*
        *
        *
        *     DO WHATEVER YOU SUPOSSE TO DO WITH YOUR PARAMETERS
        *
        *
        *
        */
			}
		}

		GCMBroadcastReceiver.completeWakefulIntent(intent);
	}

}
