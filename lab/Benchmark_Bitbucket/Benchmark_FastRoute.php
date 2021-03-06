<?php

namespace Ertuo\Lab\Benchmark_Bitbucket;

use FastRoute\RouteCollector;

abstract class Benchmark_FastRoute extends Benchmark
{
	function loadedRoutes(RouteCollector $routes) : RouteCollector
	{
		$routes->addRoute('GET', '/addon', 'addon');
		$routes->addRoute('GET', '/addon/linkers', 'addon_linkers');
		$routes->addRoute('GET', '/addon/linkers/{linker_key}', 'addon_linkers_linker_key');
		$routes->addRoute('GET', '/addon/linkers/{linker_key}/values', 'addon_linkers_linker_key_values');
		$routes->addRoute('GET', '/addon/linkers/{linker_key}/values/{value_id}', 'addon_linkers_linker_key_values_value_id');
		$routes->addRoute('GET', '/hook_events', 'hook_events');
		$routes->addRoute('GET', '/hook_events/{subject_type}', 'hook_events_subject_type');
		$routes->addRoute('GET', '/pullrequests/{selected_user}', 'pullrequests_selected_user');
		$routes->addRoute('GET', '/repositories', 'repositories');
		$routes->addRoute('GET', '/repositories/{workspace}', 'repositories_workspace');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}', 'repositories_workspace_repo_slug');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/branch-restrictions', 'repositories_workspace_repo_slug_branch_restrictions');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/branch-restrictions/{id}', 'repositories_workspace_repo_slug_branch_restrictions_id');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/branching-model', 'repositories_workspace_repo_slug_branching_model');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/branching-model/settings', 'repositories_workspace_repo_slug_branching_model_settings');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/commit/{commit}', 'repositories_workspace_repo_slug_commit_commit');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/commit/{commit}/approve', 'repositories_workspace_repo_slug_commit_commit_approve');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/commit/{commit}/comments', 'repositories_workspace_repo_slug_commit_commit_comments');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/commit/{commit}/comments/{comment_id}', 'repositories_workspace_repo_slug_commit_commit_comments_comment_id');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/commit/{commit}/properties/{app_key}/{property_name}', 'repositories_workspace_repo_slug_commit_commit_properties_app_key_property_name');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/commit/{commit}/pullrequests', 'repositories_workspace_repo_slug_commit_commit_pullrequests');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/commit/{commit}/reports', 'repositories_workspace_repo_slug_commit_commit_reports');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/commit/{commit}/reports/{reportId}', 'repositories_workspace_repo_slug_commit_commit_reports_reportId');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/commit/{commit}/reports/{reportId}/annotations', 'repositories_workspace_repo_slug_commit_commit_reports_reportId_annotations');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/commit/{commit}/reports/{reportId}/annotations/{annotationId}', 'repositories_workspace_repo_slug_commit_commit_reports_reportId_annotations_annotationId');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/commit/{commit}/statuses', 'repositories_workspace_repo_slug_commit_commit_statuses');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/commit/{commit}/statuses/build', 'repositories_workspace_repo_slug_commit_commit_statuses_build');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/commit/{commit}/statuses/build/{key}', 'repositories_workspace_repo_slug_commit_commit_statuses_build_key');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/commits', 'repositories_workspace_repo_slug_commits');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/commits/{revision}', 'repositories_workspace_repo_slug_commits_revision');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/components', 'repositories_workspace_repo_slug_components');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/components/{component_id}', 'repositories_workspace_repo_slug_components_component_id');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/default-reviewers', 'repositories_workspace_repo_slug_default_reviewers');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/default-reviewers/{target_username}', 'repositories_workspace_repo_slug_default_reviewers_target_username');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/deploy-keys', 'repositories_workspace_repo_slug_deploy_keys');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/deploy-keys/{key_id}', 'repositories_workspace_repo_slug_deploy_keys_key_id');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/deployments', 'repositories_workspace_repo_slug_deployments');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/deployments/{deployment_uuid}', 'repositories_workspace_repo_slug_deployments_deployment_uuid');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/deployments_config/environments/{environment_uuid}/variables', 'repositories_workspace_repo_slug_deployments_config_environments_environment_uuid_variables');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/deployments_config/environments/{environment_uuid}/variables/{variable_uuid}', 'repositories_workspace_repo_slug_deployments_config_environments_environment_uuid_variables_variable_uuid');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/diff/{spec}', 'repositories_workspace_repo_slug_diff_spec');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/diffstat/{spec}', 'repositories_workspace_repo_slug_diffstat_spec');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/downloads', 'repositories_workspace_repo_slug_downloads');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/downloads/{filename}', 'repositories_workspace_repo_slug_downloads_filename');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/environments/', 'repositories_workspace_repo_slug_environments');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/environments/{environment_uuid}', 'repositories_workspace_repo_slug_environments_environment_uuid');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/environments/{environment_uuid}/changes/', 'repositories_workspace_repo_slug_environments_environment_uuid_changes');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/filehistory/{commit}/{path}', 'repositories_workspace_repo_slug_filehistory_commit_path');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/forks', 'repositories_workspace_repo_slug_forks');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/hooks', 'repositories_workspace_repo_slug_hooks');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/hooks/{uid}', 'repositories_workspace_repo_slug_hooks_uid');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/issues', 'repositories_workspace_repo_slug_issues');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/issues/export', 'repositories_workspace_repo_slug_issues_export');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/issues/export/{repo_name}-issues-{task_id}.zip', 'repositories_workspace_repo_slug_issues_export_repo_name_issues_task_id_zip');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/issues/import', 'repositories_workspace_repo_slug_issues_import');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/issues/{issue_id}', 'repositories_workspace_repo_slug_issues_issue_id');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/issues/{issue_id}/attachments', 'repositories_workspace_repo_slug_issues_issue_id_attachments');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/issues/{issue_id}/attachments/{path}', 'repositories_workspace_repo_slug_issues_issue_id_attachments_path');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/issues/{issue_id}/changes', 'repositories_workspace_repo_slug_issues_issue_id_changes');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/issues/{issue_id}/changes/{change_id}', 'repositories_workspace_repo_slug_issues_issue_id_changes_change_id');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/issues/{issue_id}/comments', 'repositories_workspace_repo_slug_issues_issue_id_comments');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/issues/{issue_id}/comments/{comment_id}', 'repositories_workspace_repo_slug_issues_issue_id_comments_comment_id');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/issues/{issue_id}/vote', 'repositories_workspace_repo_slug_issues_issue_id_vote');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/issues/{issue_id}/watch', 'repositories_workspace_repo_slug_issues_issue_id_watch');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/merge-base/{revspec}', 'repositories_workspace_repo_slug_merge_base_revspec');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/milestones', 'repositories_workspace_repo_slug_milestones');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/milestones/{milestone_id}', 'repositories_workspace_repo_slug_milestones_milestone_id');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/patch/{spec}', 'repositories_workspace_repo_slug_patch_spec');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/pipelines-config/caches/', 'repositories_workspace_repo_slug_pipelines_config_caches');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/pipelines-config/caches/{cache_uuid}', 'repositories_workspace_repo_slug_pipelines_config_caches_cache_uuid');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/pipelines-config/caches/{cache_uuid}/content-uri', 'repositories_workspace_repo_slug_pipelines_config_caches_cache_uuid_content_uri');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/pipelines/', 'repositories_workspace_repo_slug_pipelines');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/pipelines/{pipeline_uuid}', 'repositories_workspace_repo_slug_pipelines_pipeline_uuid');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/pipelines/{pipeline_uuid}/steps/', 'repositories_workspace_repo_slug_pipelines_pipeline_uuid_steps');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/pipelines/{pipeline_uuid}/steps/{step_uuid}', 'repositories_workspace_repo_slug_pipelines_pipeline_uuid_steps_step_uuid');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/pipelines/{pipeline_uuid}/steps/{step_uuid}/log', 'repositories_workspace_repo_slug_pipelines_pipeline_uuid_steps_step_uuid_log');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/pipelines/{pipeline_uuid}/steps/{step_uuid}/logs/{log_uuid}', 'repositories_workspace_repo_slug_pipelines_pipeline_uuid_steps_step_uuid_logs_log_uuid');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/pipelines/{pipeline_uuid}/steps/{step_uuid}/test_reports', 'repositories_workspace_repo_slug_pipelines_pipeline_uuid_steps_step_uuid_test_reports');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/pipelines/{pipeline_uuid}/steps/{step_uuid}/test_reports/test_cases', 'repositories_workspace_repo_slug_pipelines_pipeline_uuid_steps_step_uuid_test_reports_test_cases');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/pipelines/{pipeline_uuid}/steps/{step_uuid}/test_reports/test_cases/{test_case_uuid}/test_case_reasons', 'repositories_workspace_repo_slug_pipelines_pipeline_uuid_steps_step_uuid_test_reports_test_cases_test_case_uuid_test_case_reasons');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/pipelines/{pipeline_uuid}/stopPipeline', 'repositories_workspace_repo_slug_pipelines_pipeline_uuid_stopPipeline');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/pipelines_config', 'repositories_workspace_repo_slug_pipelines_config');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/pipelines_config/build_number', 'repositories_workspace_repo_slug_pipelines_config_build_number');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/pipelines_config/schedules/', 'repositories_workspace_repo_slug_pipelines_config_schedules');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/pipelines_config/schedules/{schedule_uuid}', 'repositories_workspace_repo_slug_pipelines_config_schedules_schedule_uuid');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/pipelines_config/schedules/{schedule_uuid}/executions/', 'repositories_workspace_repo_slug_pipelines_config_schedules_schedule_uuid_executions');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/pipelines_config/ssh/key_pair', 'repositories_workspace_repo_slug_pipelines_config_ssh_key_pair');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/pipelines_config/ssh/known_hosts/', 'repositories_workspace_repo_slug_pipelines_config_ssh_known_hosts');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/pipelines_config/ssh/known_hosts/{known_host_uuid}', 'repositories_workspace_repo_slug_pipelines_config_ssh_known_hosts_known_host_uuid');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/pipelines_config/variables/', 'repositories_workspace_repo_slug_pipelines_config_variables');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/pipelines_config/variables/{variable_uuid}', 'repositories_workspace_repo_slug_pipelines_config_variables_variable_uuid');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/properties/{app_key}/{property_name}', 'repositories_workspace_repo_slug_properties_app_key_property_name');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/pullrequests', 'repositories_workspace_repo_slug_pullrequests');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/pullrequests/activity', 'repositories_workspace_repo_slug_pullrequests_activity');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/pullrequests/{pull_request_id}', 'repositories_workspace_repo_slug_pullrequests_pull_request_id');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/pullrequests/{pull_request_id}/activity', 'repositories_workspace_repo_slug_pullrequests_pull_request_id_activity');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/pullrequests/{pull_request_id}/approve', 'repositories_workspace_repo_slug_pullrequests_pull_request_id_approve');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/pullrequests/{pull_request_id}/comments', 'repositories_workspace_repo_slug_pullrequests_pull_request_id_comments');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/pullrequests/{pull_request_id}/comments/{comment_id}', 'repositories_workspace_repo_slug_pullrequests_pull_request_id_comments_comment_id');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/pullrequests/{pull_request_id}/commits', 'repositories_workspace_repo_slug_pullrequests_pull_request_id_commits');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/pullrequests/{pull_request_id}/decline', 'repositories_workspace_repo_slug_pullrequests_pull_request_id_decline');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/pullrequests/{pull_request_id}/diff', 'repositories_workspace_repo_slug_pullrequests_pull_request_id_diff');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/pullrequests/{pull_request_id}/diffstat', 'repositories_workspace_repo_slug_pullrequests_pull_request_id_diffstat');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/pullrequests/{pull_request_id}/merge', 'repositories_workspace_repo_slug_pullrequests_pull_request_id_merge');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/pullrequests/{pull_request_id}/merge/task-status/{task_id}', 'repositories_workspace_repo_slug_pullrequests_pull_request_id_merge_task_status_task_id');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/pullrequests/{pull_request_id}/patch', 'repositories_workspace_repo_slug_pullrequests_pull_request_id_patch');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/pullrequests/{pull_request_id}/request-changes', 'repositories_workspace_repo_slug_pullrequests_pull_request_id_request_changes');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/pullrequests/{pull_request_id}/statuses', 'repositories_workspace_repo_slug_pullrequests_pull_request_id_statuses');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/pullrequests/{pullrequest_id}/properties/{app_key}/{property_name}', 'repositories_workspace_repo_slug_pullrequests_pullrequest_id_properties_app_key_property_name');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/refs', 'repositories_workspace_repo_slug_refs');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/refs/branches', 'repositories_workspace_repo_slug_refs_branches');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/refs/branches/{name}', 'repositories_workspace_repo_slug_refs_branches_name');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/refs/tags', 'repositories_workspace_repo_slug_refs_tags');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/refs/tags/{name}', 'repositories_workspace_repo_slug_refs_tags_name');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/src', 'repositories_workspace_repo_slug_src');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/src/{commit}/{path}', 'repositories_workspace_repo_slug_src_commit_path');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/versions', 'repositories_workspace_repo_slug_versions');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/versions/{version_id}', 'repositories_workspace_repo_slug_versions_version_id');
		$routes->addRoute('GET', '/repositories/{workspace}/{repo_slug}/watchers', 'repositories_workspace_repo_slug_watchers');
		$routes->addRoute('GET', '/snippets', 'snippets');
		$routes->addRoute('GET', '/snippets/{workspace}', 'snippets_workspace');
		$routes->addRoute('GET', '/snippets/{workspace}/{encoded_id}', 'snippets_workspace_encoded_id');
		$routes->addRoute('GET', '/snippets/{workspace}/{encoded_id}/comments', 'snippets_workspace_encoded_id_comments');
		$routes->addRoute('GET', '/snippets/{workspace}/{encoded_id}/comments/{comment_id}', 'snippets_workspace_encoded_id_comments_comment_id');
		$routes->addRoute('GET', '/snippets/{workspace}/{encoded_id}/commits', 'snippets_workspace_encoded_id_commits');
		$routes->addRoute('GET', '/snippets/{workspace}/{encoded_id}/commits/{revision}', 'snippets_workspace_encoded_id_commits_revision');
		$routes->addRoute('GET', '/snippets/{workspace}/{encoded_id}/files/{path}', 'snippets_workspace_encoded_id_files_path');
		$routes->addRoute('GET', '/snippets/{workspace}/{encoded_id}/watch', 'snippets_workspace_encoded_id_watch');
		$routes->addRoute('GET', '/snippets/{workspace}/{encoded_id}/watchers', 'snippets_workspace_encoded_id_watchers');
		$routes->addRoute('GET', '/snippets/{workspace}/{encoded_id}/{node_id}', 'snippets_workspace_encoded_id_node_id');
		$routes->addRoute('GET', '/snippets/{workspace}/{encoded_id}/{node_id}/files/{path}', 'snippets_workspace_encoded_id_node_id_files_path');
		$routes->addRoute('GET', '/snippets/{workspace}/{encoded_id}/{revision}/diff', 'snippets_workspace_encoded_id_revision_diff');
		$routes->addRoute('GET', '/snippets/{workspace}/{encoded_id}/{revision}/patch', 'snippets_workspace_encoded_id_revision_patch');
		$routes->addRoute('GET', '/teams', 'teams');
		$routes->addRoute('GET', '/teams/{username}', 'teams_username');
		$routes->addRoute('GET', '/teams/{username}/followers', 'teams_username_followers');
		$routes->addRoute('GET', '/teams/{username}/following', 'teams_username_following');
		$routes->addRoute('GET', '/teams/{username}/hooks', 'teams_username_hooks');
		$routes->addRoute('GET', '/teams/{username}/hooks/{uid}', 'teams_username_hooks_uid');
		$routes->addRoute('GET', '/teams/{username}/members', 'teams_username_members');
		$routes->addRoute('GET', '/teams/{username}/permissions', 'teams_username_permissions');
		$routes->addRoute('GET', '/teams/{username}/permissions/repositories', 'teams_username_permissions_repositories');
		$routes->addRoute('GET', '/teams/{username}/permissions/repositories/{repo_slug}', 'teams_username_permissions_repositories_repo_slug');
		$routes->addRoute('GET', '/teams/{username}/pipelines_config/variables/', 'teams_username_pipelines_config_variables');
		$routes->addRoute('GET', '/teams/{username}/pipelines_config/variables/{variable_uuid}', 'teams_username_pipelines_config_variables_variable_uuid');
		$routes->addRoute('GET', '/teams/{username}/projects/', 'teams_username_projects');
		$routes->addRoute('GET', '/teams/{username}/projects/{project_key}', 'teams_username_projects_project_key');
		$routes->addRoute('GET', '/teams/{username}/search/code', 'teams_username_search_code');
		$routes->addRoute('GET', '/teams/{workspace}/repositories', 'teams_workspace_repositories');
		$routes->addRoute('GET', '/user', 'user');
		$routes->addRoute('GET', '/user/emails', 'user_emails');
		$routes->addRoute('GET', '/user/emails/{email}', 'user_emails_email');
		$routes->addRoute('GET', '/user/permissions/repositories', 'user_permissions_repositories');
		$routes->addRoute('GET', '/user/permissions/teams', 'user_permissions_teams');
		$routes->addRoute('GET', '/user/permissions/workspaces', 'user_permissions_workspaces');
		$routes->addRoute('GET', '/users/{selected_user}', 'users_selected_user');
		$routes->addRoute('GET', '/users/{selected_user}/hooks', 'users_selected_user_hooks');
		$routes->addRoute('GET', '/users/{selected_user}/hooks/{uid}', 'users_selected_user_hooks_uid');
		$routes->addRoute('GET', '/users/{selected_user}/pipelines_config/variables/', 'users_selected_user_pipelines_config_variables');
		$routes->addRoute('GET', '/users/{selected_user}/pipelines_config/variables/{variable_uuid}', 'users_selected_user_pipelines_config_variables_variable_uuid');
		$routes->addRoute('GET', '/users/{selected_user}/properties/{app_key}/{property_name}', 'users_selected_user_properties_app_key_property_name');
		$routes->addRoute('GET', '/users/{selected_user}/search/code', 'users_selected_user_search_code');
		$routes->addRoute('GET', '/users/{selected_user}/ssh-keys', 'users_selected_user_ssh_keys');
		$routes->addRoute('GET', '/users/{selected_user}/ssh-keys/{key_id}', 'users_selected_user_ssh_keys_key_id');
		$routes->addRoute('GET', '/users/{username}/members', 'users_username_members');
		$routes->addRoute('GET', '/users/{workspace}/repositories', 'users_workspace_repositories');
		$routes->addRoute('GET', '/workspaces', 'workspaces');
		$routes->addRoute('GET', '/workspaces/{workspace}', 'workspaces_workspace');
		$routes->addRoute('GET', '/workspaces/{workspace}/hooks', 'workspaces_workspace_hooks');
		$routes->addRoute('GET', '/workspaces/{workspace}/hooks/{uid}', 'workspaces_workspace_hooks_uid');
		$routes->addRoute('GET', '/workspaces/{workspace}/members', 'workspaces_workspace_members');
		$routes->addRoute('GET', '/workspaces/{workspace}/members/{member}', 'workspaces_workspace_members_member');
		$routes->addRoute('GET', '/workspaces/{workspace}/permissions', 'workspaces_workspace_permissions');
		$routes->addRoute('GET', '/workspaces/{workspace}/permissions/repositories', 'workspaces_workspace_permissions_repositories');
		$routes->addRoute('GET', '/workspaces/{workspace}/permissions/repositories/{repo_slug}', 'workspaces_workspace_permissions_repositories_repo_slug');
		$routes->addRoute('GET', '/workspaces/{workspace}/pipelines-config/identity/oidc/.well-known/openid-configuration', 'workspaces_workspace_pipelines_config_identity_oidc_well_known_openid_configuration');
		$routes->addRoute('GET', '/workspaces/{workspace}/pipelines-config/identity/oidc/keys.json', 'workspaces_workspace_pipelines_config_identity_oidc_keys_json');
		$routes->addRoute('GET', '/workspaces/{workspace}/pipelines-config/variables', 'workspaces_workspace_pipelines_config_variables');
		$routes->addRoute('GET', '/workspaces/{workspace}/pipelines-config/variables/{variable_uuid}', 'workspaces_workspace_pipelines_config_variables_variable_uuid');
		$routes->addRoute('GET', '/workspaces/{workspace}/projects', 'workspaces_workspace_projects');
		$routes->addRoute('GET', '/workspaces/{workspace}/projects/{project_key}', 'workspaces_workspace_projects_project_key');
		$routes->addRoute('GET', '/workspaces/{workspace}/search/code', 'workspaces_workspace_search_code');

		return $routes;
	}
}
